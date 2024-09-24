<?php
namespace Avaliacao\Web\Common;

final class ProblemAndFiledError {
    
    private static $fieldsError = array();


    public static function addFieldsWithError($field) {
        return ProblemAndFiledError::$fieldsError[$field["field"]] = $field["message"];
    }

    public static function getFieldsError() {
        return ProblemAndFiledError::$fieldsError;
    }
}
