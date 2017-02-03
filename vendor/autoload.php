<?php
spl_autoload_register(
    function ($className) {
        static $directoryPath;
        // Определение базовой директории файлов приложения:
        if (is_null($directoryPath)) {
            $directoryPath = __DIR__ . DS . '..';
        }
        $names = explode('\\', $className);
        $root = array_shift($names);
        // Обрабатывать только классы из пространства iDirector:
        if ($root === 'test2') {
            $filePath = implode(DS, $names) . '.php';
            include_once($directoryPath . DS . $filePath);
        }
    },
    true,
    true
);
?>