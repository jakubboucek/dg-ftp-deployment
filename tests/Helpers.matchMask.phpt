<?php

use Deployment\Helpers;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


Assert::false(Helpers::matchMask('/deployment.ini', ['*.i[xy]i']));
Assert::false(Helpers::matchMask('/deployment.ini', ['*.i[!n]i']));
Assert::true(Helpers::matchMask('/deployment.ini', ['*.ini']));
Assert::false(Helpers::matchMask('deployment.ini', ['*.ini/']));
Assert::true(Helpers::matchMask('deployment.ini', ['/*.ini']));
Assert::true(Helpers::matchMask('.git', ['.g*']));
Assert::false(Helpers::matchMask('.git', ['.g*/']));

Assert::false(Helpers::matchMask('deployment.ini', ['*.ini', '!dep*']));
Assert::true(Helpers::matchMask('deployment.ini', ['*.ini', '!dep*', '*ment*']));

// a/* disallowes everything to the right, i.e. a/*/*/*
// !a/*/c allowes directories to the left, i.e. a, a/*
Assert::true(Helpers::matchMask('a', ['a']));
Assert::true(Helpers::matchMask('a', ['a'], true));
Assert::false(Helpers::matchMask('a/b', ['a']));
Assert::false(Helpers::matchMask('a/b', ['a'], true));
Assert::true(Helpers::matchMask('a/b', ['b']));
Assert::true(Helpers::matchMask('a/b', ['b'], true));
Assert::false(Helpers::matchMask('a/b', ['c']));
Assert::false(Helpers::matchMask('a/b', ['c'], true));
Assert::false(Helpers::matchMask('a', ['*', '!a']));
Assert::false(Helpers::matchMask('a', ['*', '!a'], true));
Assert::true(Helpers::matchMask('a/b', ['*', '!a']));
Assert::true(Helpers::matchMask('a/b', ['*', '!a'], true));
Assert::false(Helpers::matchMask('a/b', ['*', '!b']));
Assert::false(Helpers::matchMask('a/b', ['*', '!b'], true));
Assert::true(Helpers::matchMask('a/b', ['*', '!c']));
Assert::true(Helpers::matchMask('a/b', ['*', '!c'], true));

Assert::true(Helpers::matchMask('a', ['/a']));
Assert::true(Helpers::matchMask('a', ['/a'], true));
Assert::true(Helpers::matchMask('a/b', ['/a']));
Assert::true(Helpers::matchMask('a/b', ['/a'], true));
Assert::true(Helpers::matchMask('a/b/b', ['/a']));
Assert::true(Helpers::matchMask('a/b/b', ['/a'], true));
Assert::false(Helpers::matchMask('a', ['*', '!/a']));
Assert::false(Helpers::matchMask('a', ['*', '!/a'], true));
Assert::false(Helpers::matchMask('a/b', ['*', '!/a']));
Assert::false(Helpers::matchMask('a/b', ['*', '!/a'], true));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!/a']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!/a'], true));
Assert::false(Helpers::matchMask('a', ['a/']));
Assert::true(Helpers::matchMask('a', ['a/'], true));
Assert::true(Helpers::matchMask('a/b', ['a/']));
Assert::true(Helpers::matchMask('a/b', ['a/'], true));
Assert::true(Helpers::matchMask('a/b/b', ['a/']));
Assert::true(Helpers::matchMask('a/b/b', ['a/'], true));
Assert::true(Helpers::matchMask('a', ['*', '!a/']));
Assert::false(Helpers::matchMask('a', ['*', '!a/'], true));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/']));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/'], true));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/'], true));
Assert::false(Helpers::matchMask('a', ['a/*']));
Assert::false(Helpers::matchMask('a', ['a/*'], true));
Assert::true(Helpers::matchMask('a/b', ['a/*']));
Assert::true(Helpers::matchMask('a/b', ['a/*'], true));
Assert::true(Helpers::matchMask('a/b/b', ['a/*']));
Assert::true(Helpers::matchMask('a/b/b', ['a/*'], true));
Assert::true(Helpers::matchMask('a', ['*', '!a/*']));
Assert::false(Helpers::matchMask('a', ['*', '!a/*'], true));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/*']));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/*'], true));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*'], true));
Assert::false(Helpers::matchMask('a', ['a/*/']));
Assert::false(Helpers::matchMask('a', ['a/*/'], true));
Assert::false(Helpers::matchMask('a/b', ['a/*/']));
Assert::true(Helpers::matchMask('a/b', ['a/*/'], true));
Assert::true(Helpers::matchMask('a/b/b', ['a/*/']));
Assert::true(Helpers::matchMask('a/b/b', ['a/*/'], true));
Assert::true(Helpers::matchMask('a', ['*', '!a/*/']));
Assert::false(Helpers::matchMask('a', ['*', '!a/*/'], true));
Assert::true(Helpers::matchMask('a/b', ['*', '!a/*/']));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/*/'], true));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*/']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*/'], true));
Assert::false(Helpers::matchMask('a', ['a/*/b']));
Assert::false(Helpers::matchMask('a', ['a/*/b'], true));
Assert::false(Helpers::matchMask('a/b', ['a/*/b']));
Assert::false(Helpers::matchMask('a/b', ['a/*/b'], true));
Assert::true(Helpers::matchMask('a/b/b', ['a/*/b']));
Assert::true(Helpers::matchMask('a/b/b', ['a/*/b'], true));
Assert::false(Helpers::matchMask('a/b/c', ['a/*/b']));
Assert::false(Helpers::matchMask('a/b/c', ['a/*/b'], true));
Assert::true(Helpers::matchMask('a', ['*', '!a/*/b']));
Assert::false(Helpers::matchMask('a', ['*', '!a/*/b'], true));
Assert::true(Helpers::matchMask('a/b', ['*', '!a/*/b']));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/*/b'], true));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*/b']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*/b'], true));
Assert::true(Helpers::matchMask('a/b/c', ['*', '!a/*/b']));
Assert::true(Helpers::matchMask('a/b/c', ['*', '!a/*/b'], true));
Assert::false(Helpers::matchMask('a', ['a/*/b/']));
Assert::false(Helpers::matchMask('a', ['a/*/b/'], true));
Assert::false(Helpers::matchMask('a/b', ['a/*/b/']));
Assert::false(Helpers::matchMask('a/b', ['a/*/b/'], true));
Assert::false(Helpers::matchMask('a/b/b', ['a/*/b/']));
Assert::true(Helpers::matchMask('a/b/b', ['a/*/b/'], true));
Assert::false(Helpers::matchMask('a/b/c', ['a/*/b/']));
Assert::false(Helpers::matchMask('a/b/c', ['a/*/b/'], true));
Assert::true(Helpers::matchMask('a', ['*', '!a/*/b/']));
Assert::false(Helpers::matchMask('a', ['*', '!a/*/b/'], true));
Assert::true(Helpers::matchMask('a/b', ['*', '!a/*/b/']));
Assert::false(Helpers::matchMask('a/b', ['*', '!a/*/b/'], true));
Assert::true(Helpers::matchMask('a/b/b', ['*', '!a/*/b/']));
Assert::false(Helpers::matchMask('a/b/b', ['*', '!a/*/b/'], true));
Assert::true(Helpers::matchMask('a/b/c', ['*', '!a/*/b/']));
Assert::true(Helpers::matchMask('a/b/c', ['*', '!a/*/b/'], true));
