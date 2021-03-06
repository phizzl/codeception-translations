# Translations for Codeception

The module allows you to add translations in your suite config.
This may be usefull when working with a multilingual website.

You may define your translations as module config

```yaml
actor: AcceptanceTester
modules:
    enabled:
        - \Phizzl\Codeception\Modules\Translations\TranslationsModule
    config:
        \Phizzl\Codeception\Modules\Translations\TranslationsModule:
            translations:
                "Welcome friend": "Willkommen Freund"
                "good": "gut"
```

Of course you can also use environments to have different translations.

You're also able to load translations from a separate yaml file. Instead filling the _translations_ option with an array structure you can add a file

```yaml
actor: AcceptanceTester
modules:
    enabled:
        - \Phizzl\Codeception\Modules\Translations\TranslationsModule
    config:
        \Phizzl\Codeception\Modules\Translations\TranslationsModule:
            translations: "lang_en.yml"
```
If you dont use an absolute path the given file will be searched in your configured data directory.

Now you are able to translate strings in your Cest files.

```php
public function tryToTest(AcceptanceTester $I)
{
    $welcomeText = $I->translate("Welcome friend"); // result: Willkommen Freund
    
    $I->amOnPage('/');
    $I->see($welcomeText);
    
    /* You are also able to translate only placeholder within a string using the defined keys. Just use the ${key} expression in your string. */
    $statusText = $I->translate("Status: \${good}"); // result: Status: gut
    
    $I->see($statusText);
}
```
