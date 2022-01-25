<?php

namespace Core;

use Config\Config;
use Exception;

class View
{
    public array $errors;
    public array $sidebar = [];
    private $_currentContent, $_buffer, $_layout;
    private array $_content = [];
    private ?string $_siteTitle = '';
    private string $_defaultViewPath;

    public function __construct($path)
    {
        $this->_defaultViewPath = $path;
        $this->_siteTitle = Config::get('default_site_title');
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout): void
    {
        $this->_layout = $layout;
    }

    /**
     * @return string|null
     */
    public function getSiteTitle(): ?string
    {
        return $this->_siteTitle;
    }

    /**
     * @param string|null $siteTitle
     */
    public function setSiteTitle(?string $siteTitle): void
    {
        $this->_siteTitle = $siteTitle;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->_layout;
    }

    /**
     * @throws Exception
     */
    public function render($path = '')
    {
        if (empty($path)) {
            $path = $this->_defaultViewPath;
        }
        $layoutPath = PROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php';
        $fullPath = PROOT . DS . 'app' . DS . 'views' . DS . $path . '.php';
        if (!file_exists($fullPath)) throw new Exception("The view \"{$path}\" does not exist.");
        if (!file_exists($layoutPath)) throw new Exception("The layout \"{$this->_layout}\" does not exist.");
        include($fullPath);
        include($layoutPath);
    }

    /**
     * @throws Exception
     */
    public function start($key)
    {
        if (empty($key)) throw new Exception("The start method requires a valid key");
        $this->_buffer = $key;
        ob_start(); //Start an output buffer
    }

    /**
     * @throws Exception
     */
    public function end()
    {
        if (empty($this->_buffer)) throw new Exception("Start method has not been called");
        $this->_content[$this->_buffer] = ob_get_clean();
        $this->_buffer = null;
    }

    public function content($key)
    {
        if (array_key_exists($key, $this->_content)) echo $this->_content[$key];
    }

    public function partial($path)
    {
        $fullPath = PROOT . DS . 'app' . DS . 'views' . DS . $path . '.php';
        if (file_exists($fullPath)) include($fullPath);
    }
}