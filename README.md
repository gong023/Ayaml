# Ayaml

[![Build Status](https://travis-ci.org/gong023/Ayaml.svg)](https://travis-ci.org/gong023/Ayaml)
[![Coverage Status](https://img.shields.io/coveralls/gong023/Ayaml.svg?style=flat)](https://coveralls.io/r/gong023/Ayaml)

Utility for making Array from Yaml.

# Setup

Install Ayaml

```bash
composer require --dev gong023/ayaml:dev-master
```

Register yaml dir in testing bootstrap.php

```php
\Ayaml\Ayaml::registerBasePath('/Dir/YamlFile/Exists');
```

# Usage

Example yaml file is below.

```yaml
# /Dir/YamlFile/Exists/User.yaml
valid_user:
  id: 1
  name: Taro
  created: 2014-01
```

You can create array from above yaml file.

```php
// plain pattern
Ayaml::file('user')->schema('valid_user')->dump();
=> ['id' => 1, 'name' => 'Taro', 'created' => '2014-01'];

// with overwriting
Ayaml::file('user')->schema('valid_user')->with(['id' => 2, 'name' => 'John'])->dump();
=> ['id' => 2, 'name' => 'John', 'created' => '2014-01'];
```

# TODO
I will implement below interface.

```php
// create sequential array.
$validUser = Ayaml::file('user')->schema('valid_user');
Ayaml::seq($validUser)->range('id', 10, 12)->byOne()->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 11, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-01'],
];

Ayaml::seq($validUser)->range('id', 10, 8)->byOne()->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 9,  'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 8,  'name' => 'Taro', 'created' => '2014-01'],
]

Ayaml::seq($validUser)->range('id', 10, 12)->by(function($id) { return $id + 2; })->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-01'],
];

Ayaml::seq($validUser)->between('created', '2014-01', '2014-03')->byMonth()->dump();
=>
[
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-02'],
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-03'],
];

Ayaml::seq($validUser)
  ->range('id', 10, 13)->byOne()
  ->between('created', '2014-01', '2014-03')->byMonth()
  ->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 11, 'name' => 'Taro', 'created' => '2014-02'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-03'],
];
```
