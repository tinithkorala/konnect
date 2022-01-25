<?php

namespace Core;

use JetBrains\PhpStorm\Pure;

class FormHelpers
{
    /**
     * @param $label
     * @param $id
     * @param $value
     * @param array $inputAttrs
     * @param array $wrapperAttrs
     * @param array $errors
     * @return string
     */
    public static function inputBlock($label, $id, $value, array $inputAttrs = [], array $wrapperAttrs = [], array $errors = []): string
    {
        $wrapperStr = self::processAttributes($wrapperAttrs);
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttributes($inputAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'> {$label} </label> ";
        $html .= "<input id='{$id}' name='{$id}' value='{$value}' {$inputAttrs}/>";
        $html .= "<small class='is-invalid'> {$errorMsg} </small>";
        $html .= "</div>";
        return $html;
    }

    /**
     * @param array $attrs
     * @return string
     */
    public static function processAttributes(array $attrs = []): string
    {
        $html = '';
        foreach ($attrs as $key => $value) {
            $html .= " {$key}= '{$value}'";
        }
        return $html;
    }

    /**
     * @param $key
     * @param $inputAttrs
     * @param $errors
     * @return mixed
     */
    public static function appendErrors($key, $inputAttrs, $errors)
    {
        if (array_key_exists($key, $errors)) {
            if (array_key_exists('class', $inputAttrs)) {
                $inputAttrs['class'] .= ' error-field';
            } else $inputAttrs['class'] = 'error-field';
        }
        return $inputAttrs;
    }

    /**
     * @param string $label
     * @param string $id
     * @param $value
     * @param array $options
     * @param array $inputAttrs
     * @param array $wrapperAttrs
     * @param array $errors
     * @return string
     */
    #[Pure] public static function selectBlock(string $label, string $id, $value, array $options, array $inputAttrs = [], array $wrapperAttrs = [], array $errors = []): string
    {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttributes($inputAttrs);
        $wrapperStr = self::processAttributes($wrapperAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : '';
        $html = "<div {$wrapperStr} ";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<select id='{$id}' name='{$id}' {$inputAttrs}>";
        foreach ($options as $val => $display) {
            $selected = $val == $value ? 'selected' : '';
            $html .= "<option value='{$val}' {$selected}> {$display} </option>";
        }
        $html .= "</select>";
        $html .= "<small class='is-invalid'> {$errorMsg} </small>";
        $html .= "</div>";
        return $html;
    }

    /**
     * @param $label
     * @param $id
     * @param string $checked
     * @param array $inputAttrs
     * @param array $wrapperAttrs
     * @param array $errors
     * @return string
     */
    #[Pure] public static function check($label, $id, string $checked = '', array $inputAttrs = [], array $wrapperAttrs = [], array $errors = []): string
    {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $wrapperStr = self::processAttributes($wrapperAttrs);
        $inputStr = self::processAttributes($inputAttrs);
        $checkedStr = $checked == 'on' ? "checked" : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<input type=\"checkbox\" id=\"{$id}\" name=\"{$id}\" {$inputStr} {$checkedStr}>";
        $html .= "<label class=\"form-check-label\" for=\"{$id}\">{$label}</label></div>";
        return $html;
    }

    /**
     * @return string
     */
    public static function csrfField(): string
    {
        $token = Session::createCsrfToken();
        return "<input type='hidden' value={$token} name='csrfToken'/>";
    }

    /**
     * @param $label
     * @param $id
     * @param $value
     * @param array $inputAttributes
     * @param array $wrapperAttributes
     * @param array $errors
     * @return string
     */
    #[Pure] public static function textarea($label, $id, $value, array $inputAttributes = [], array $wrapperAttributes = [], array $errors = []): string
    {
        $wrapperString = self::processAttributes($wrapperAttributes);
        $inputAttributes = self::appendErrors($id, $inputAttributes, $errors);
        $inputAttributes = self::processAttributes($inputAttributes);
        $errorMessage = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperString}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<textarea id='{$id}' name='{$id}' value='{$value}' {$inputAttributes}>{$value}</textarea>";
        $html .= "<small class='is-invalid text-sm'>{$errorMessage}</small></div>";
        return $html;
    }

    #[Pure] public static function fileUpload($id, $input = [], $errors = [], $label = ''){
        $inputAttributes = self::appendErrors($id, $input, $errors);
        $inputString = self::processAttributes($inputAttributes);
        $errorMessage = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div>";
        if($label) $html .= "<label for='{$id}'> {$label} </label>";
        $html .= "<input type='file' id='{$id}' name='{$id}' {$inputString}/>";
        $html .= "<div class='is-invalid text-sm'> {$errorMessage} </div></div>";
        return $html;
    }
}