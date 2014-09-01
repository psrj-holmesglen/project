@java -jar compiler.jar --js=www\js\main.js --js_output_file=temp.js
@IF ERRORLEVEL 1 EXIT 1
@java -jar compiler.jar --js=www\js\transfer.js --js_output_file=temp.js
@IF ERRORLEVEL 1 EXIT 1
@java -jar compiler.jar --js=www\js\jqm.defaults.js --js_output_file=temp.js
@IF ERRORLEVEL 1 EXIT 1
@DEL temp.js
@IF ERRORLEVEL 1 EXIT 1
