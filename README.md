YII 2 Gentellela Admin CRUD
==========================

Gentellela Admin
https://github.com/puikinsh/gentelella

Интеграция Gentellela шаблона к CRUD в Gii.

## Установка CRUD шаблона

Нужно выполнить:

    composer require ceyhunism/yii2-gentellela-crud-template

или добавить в composer.json в "required"

    "ceyhunism/yii2-gentellela-crud-template": "dev-master"

----
Альтернативный способ установки:
    Скопировать весь проект ceyhunism/yii2-gentellela-crud-template в папку @vendor

## Настройка GII шаблона

В конфигурационном файле /config/main.php нужно добавить:

```````
$config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
          'generators' => [ 
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [ 
                    'custom' => '@vendor/ceyhunism/yii2-gentellela-crud-template',
                ]
            ]
        ],
    ];
```````

После этого при использовании CRUD в Gii в разделе "Code Template" необходимо выбрать соответствующий шаблон.

##Flash cообщения
Для использования flash сообщений в базовом контроллере, который расширяют другие контроллеры необходимо объявить функцию set_session

```````
protected function set_session($type, $message)
{
    Yii::$app->session->setFlash($type, Html::encode($message));
}
```````