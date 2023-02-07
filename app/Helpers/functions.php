<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

function uploadFileUniqueForTable(
    string  $attributeName,
    object  $model,
    Request $request,
    array   $acceptExtension,
    string  $fieldUser,
    int     $idUser
)
{
    if ($request->hasFile($attributeName)) {
        $file = $request->file($attributeName);
        foreach ($acceptExtension as $extension) {
            if ($file->getClientOriginalExtension() == $extension) {
                $user = \Illuminate\Support\Facades\Auth::user();
                $storeFileName = $file->store($model->getTable() . "/" . $user["id"], ["disk" => "public"]);
                if ($storeFileName) {
                    $request["description"] = "Arquivo referente a tabela (" . $model->getTable() . "),  Para o usuário (" . $user["first_name"] . ")";
                    $request["extension"] = $file->getClientOriginalExtension();
                    $request["name"] = $storeFileName;
                    $request["size"] = $file->getSize();
                    $request[$fieldUser] = $idUser;
                    $request["type"] = $file->getClientMimeType();
                    $store = $model->create($request->all());
                    return $request;
                }
            }
        }
    }
    return false;
}

function uploadFile(
    string  $attributeName,
    Request $request,
    array   $acceptExtension = [],
    $savePath = "/filesGeneric",
    $operation = "create",
    Model $model = null
)
{
    $storeFileName = null;
    if ($request->hasFile($attributeName)) {
        if ($operation == "update" && isset($model->$attributeName) && Storage::exists($model->$attributeName)) {
            if (is_file($model->$attributeName)) {
                Storage::delete($model->$attributeName);
                unlink($model->$attributeName);
            }
        }
        $file = $request->file($attributeName);
        foreach ($acceptExtension as $extension) {
            $extension = strtolower($extension);
            $originalExtension = strtolower($file->getClientOriginalExtension());
            if ($originalExtension == $extension) {
                $storeFileName = $file->store($savePath, ["disk" => "public"]);
            }
        }
    }
    $storeFileName = $storeFileName ? "/storage/" . $storeFileName : null;

    return $storeFileName ?? $model->$attributeName ?? null;
}

function sanitizeString($valor)
{
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace(" ", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    return $valor;
}

function listUserPerRoles(array $nameRoles, $string = false)
{
    $return =  User::whereHas("roles", function ($roles) use ($nameRoles) {
        $roles->whereIn("name", $nameRoles);
    })->pluck("id")->toArray();

    if($string) {
        $return = implode(",", $return);
    }

    return $return;
}
