#!/bin/bash
rm -rf ./docs/api
vendor/bin/phpdoc project:run -d ./src -t ./docs/api --template=xml
vendor/bin/phpdocmd docs/api/structure.xml docs/api
rm -rf ./docs/api/phpdoc*
mv ./docs/api/ApiIndex.md ./docs/api/Index.md
rm ./docs/api/structure.xml