var thisDom =  this;

var ERROR_CODES = {
    'WALL': 'Karel ha chocado con un muro!',
    'WORLDUNDERFLOW':
        'Karel intentó tomar zumbadores en una posición donde no había!',
    'BAGUNDERFLOW':
        'Karel intentó dejar un zumbador pero su mochila estaba vacía!',
    'INSTRUCTION': 'Karel ha superado el límite de instrucciones!',
    'STACK': 'La pila de karel se ha desbordado!'
};
var COMPILATION_ERROR = 'Error de compilación';
var ERROR_TOKENS = {
    pascal: {
        BEGINPROG: '"iniciar-programa"',
        BEGINEXEC: '"inicia-ejecución"',
        ENDEXEC: '"termina-ejecución"',
        ENDPROG: '"finalizar-programa"',
        DEF: '"define-nueva-instrucción"',
        PROTO: '"define-prototipo-instrucción"',
        RET: '"sal-de-instrucción"',
        AS: '"como"',
        HALT: '"apágate"',
        LEFT: '"gira-izquierda"',
        FORWARD: '"avanza"',
        PICKBUZZER: '"coge-zumbador"',
        LEAVEBUZZER: '"deja-zumbador"',
        BEGIN: '"inicio"',
        END: '"fin"',
        THEN: '"entonces"',
        WHILE: '"mientras"',
        DO: '"hacer"',
        REPEAT: '"repetir"',
        TIMES: '"veces"',
        DEC: '"precede"',
        INC: '"sucede"',
        IFZ: '"si-es-cero"',
        IFNFWALL: '"frente-libre"',
        IFFWALL: '"frente-bloqueado"',
        IFNLWALL: '"izquierda-libre"',
        IFLWALL: '"izquierda-bloqueada"',
        IFNRWALL: '"derecha-libre"',
        IFRWALL: '"derecha-bloqueada"',
        IFWBUZZER: '"junto-a-zumbador"',
        IFNWBUZZER: '"no-junto-a-zumbador"',
        IFBBUZZER: '"algún-zumbador-en-la-mochila"',
        IFNBBUZZER: '"ningún-zumbador-en-la-mochila"',
        IFN: '"orientado-al-norte"',
        IFS: '"orientado-al-sur"',
        IFE: '"orientado-al-este"',
        IFW: '"orientado-al-oeste"',
        IFNN: '"no-orientado-al-norte"',
        IFNS: '"no-orientado-al-sur"',
        IFNE: '"no-orientado-al-este"',
        IFNW: '"no-orientado-al-oeste"',
        ELSE: '"si-no"',
        IF: '"si"',
        NOT: '"no"',
        OR: '"o"',
        AND: '"y"', '(': '"("', ')': '")"', ';': '";"',
        NUM: 'un número',
        VAR: 'un nombre',
        EOF: 'el final del programa'
    },
    java: {
        CLASS: '"class"',
        PROG: '"program"',
        DEF: '"void"',
        RET: '"return"',
        HALT: '"turnoff"',
        LEFT: '"turnleft"',
        FORWARD: '"move"',
        PICKBUZZER: '"pickbeeper"',
        LEAVEBUZZER: '"putbeeper"',
        WHILE: '"while"',
        REPEAT: '"iterate"',
        DEC: '"pred"',
        INC: '"succ"',
        IFZ: '"iszero"',
        IFNFWALL: '"frontIsClear"',
        IFFWALL: '"frontIsBlocked"',
        IFNLWALL: '"leftIsClear"',
        IFLWALL: '"leftIsBlocked"',
        IFNRWALL: '"rightIsClear"',
        IFRWALL: '"rightIsBlocked"',
        IFWBUZZER: '"nextToABeeper"',
        IFNWBUZZER: '"notNextToABeeper"',
        IFBBUZZER: '"anyBeepersInBeeperBag"',
        IFNBBUZZER: '"noBeepersInBeeperBag"',
        IFN: '"facingNorth"',
        IFS: '"facingSouth"',
        IFE: '"facingEast"',
        IFW: '"facingWest"',
        IFNN: '"notFacingNorth"',
        IFNS: '"notFacingSouth"',
        IFNE: '"notFacingEast"',
        IFNW: '"notFacingWest"',
        ELSE: '"else"',
        IF: '"if"',
        NOT: '"!"',
        OR: '"||"',
        AND: '"&"', '(': '"("', ')': '")"',
        BEGIN: '"{"',
        END: '"}"', ';': '";"',
        NUM: 'un número',
        VAR: 'un nombre',
        EOF: 'el final del programa'
    },
};
var editor = null;



var _world = null;
var world = null;

//hack para que funcionen las parades iniciales del miundo.. ¿¿?¿ no sè por que...
var h = null;
var w = null;
//fin hack

var context = null;
var _wRender = null;

var wRender = null;
var _mundo = null;

var mundo = null;
var mundo_editable = null;
var linea_actual = null;
var currentCell = null;
var src = null;
var interval = null;


function parseWorld(xml) {
    // Parses the xml and returns a document object.
    return new DOMParser().parseFromString(xml, 'text/xml');
}
function getTheme() {
    return (typeof (sessionStorage) !== 'undefined' &&
        sessionStorage.getItem('karel.js:theme')) ||
        'karel';
}

var recalcDimensionsEditorInterval = setInterval(function () {
    var a = $("#editor").width();
    var b = $("#editor").height();

    if (a > 0 && b > 0) {
        editor = CodeMirror.fromTextArea($("#editor").get(0), {
            lineNumbers: true,
            firstLineNumber: 1,
            styleActiveLine: true,
            viewportMargin: Infinity,
            mode: 'kareljava',
            theme: 'karel',
            foldGutter: {
                rangeFinder: CodeMirror.fold.indent,
            },
            gutters: [
                'CodeMirror-foldgutter',
                'errors',
                'breakpoints',
                'CodeMirror-linenumbers'
            ],
            extraKeys: {
                Tab: function(cm) {
                    console.log('inserting tab')
                    cm.replaceSelection('    ');
                }
            }
        });


        // Preparación del editor
        editor.numBreakpoints = 0;
        editor.on('gutterClick', function (instance, line, gutter, clickEvent) {
            if (gutter === 'CodeMirror-foldgutter') return;

            var markers = instance.lineInfo(line).gutterMarkers;
            if (markers && markers.breakpoints) {
                instance.setGutterMarker(line, 'breakpoints', null);
                editor.numBreakpoints--;
            } else {
                instance.setGutterMarker(line, 'breakpoints', makeBreakpoint());
                editor.numBreakpoints++;
            }
        });
        editor.on('change',function(){
            console.log("saving",$("#editor").val())
            $("#editor").val(editor.getValue())
        });
        clearInterval(recalcDimensionsEditorInterval)
    }
}, 50);
function getParser(str) {
    var language = detectLanguage(str);

    switch (language) {
        case 'pascal':
            return {parser: new karelpascal.Parser(), name: 'pascal'};
            break;
        case 'java':
            return {parser: new kareljava.Parser(), name: 'java'};
            break;
        case 'ruby':
            return {parser: new karelruby.Parser(), name: 'ruby'};
            break;
        default:
            return {parser: new kareljava.Parser(), name: 'pascal'};
            break;
    }
}
function parseError(str, hash) {
    if (hash.recoverable) {
        this.trace(str);
    } else {
        var e = new Error(str);
        for (var n in hash) {
            if (hash.hasOwnProperty(n)) {
                e[n] = hash[n];
            }
        }
        e.text = e.text;
        var line = editor.getLine(e.line);
        var i = line.indexOf(e.text, hash.loc ? hash.loc.first_column : 0);
        if (i == -1) {
            i = line.indexOf(e.text);
        }
        if (i != -1) {
            e.loc = {
                first_line: e.line,
                last_line: e.line,
                first_column: i,
                last_column: i + e.text.length
            };
        } else {
            e.loc = {
                first_line: e.line,
                last_line: e.line + 1,
                first_column: 0,
                last_column: 0
            };
        }
        throw e;
    }
}
function addEventListeners(world) {
    world.runtime.addEventListener('debug', function (evt) {
        console.log(evt);
    });
    world.runtime.addEventListener('call', function (evt) {
        $('#pila')
            .prepend('<div class="well well-small">' + evt.function + '(' +
                evt.param + ') Línea <span class="badge badge-info">' +
                (evt.line + 1) + '</span></div>');
    });
    world.runtime.addEventListener('return', function (evt) {
        var arreglo = $('#pila > div:first-child').remove();
    });
    world.runtime.addEventListener('start', function (evt) {
        var arreglo = $('#pila > div:first-child').remove();
    });
}
function getSyntax(str) {
    var parser = getParser(str);
    parser.parser.yy.parseError = parseError;
    return parser;
}
function validatorCallbacks(message) {
    if (message.type == 'error') {
        $(thisDom).find('#mensajes').trigger('error', {mensaje: message.message});
    } else if (message.type == 'info') {
        $(thisDom).find('#mensajes').trigger('info', {mensaje: message.message});
    } else if (message.type == 'invalidCell') {
        $(thisDom).find('#mensajes')
            .trigger('error', {
                mensaje: 'La celda (' + message.x + ', ' + message.y +
                    ') es inválida'
            });
    } else {
        console.error('Mensaje no reconocido', message);
    }
}
function highlightCurrentLine() {
    if (linea_actual != null) {
        editor.removeLineClass(linea_actual, 'background',
            'karel-current-line');
    }

    if (mundo.runtime.state.line >= 0) {
        linea_actual = mundo.runtime.state.line;
        editor.addLineClass(linea_actual, 'background', 'karel-current-line');
        editor.setCursor({line: linea_actual, ch: 0});
    }
}
function step() {
    // Avanza un paso en la ejecución del código
    console.log("vamos a comenzar el paso")
    mundo.runtime.step();
    highlightCurrentLine();
    var markers = editor.lineInfo(linea_actual).gutterMarkers;
    if (markers && markers.breakpoints && interval) {
        console.log('Breakpoint en la línea ' + (linea_actual + 1));
        clearInterval(interval);
        interval = null;
    }
    if (mundo.dirty) {
        console.log("el mundo es dirty")

        mundo.dirty = false;
        wRender.paint(mundo, world.width, world.height, {track_karel: true});
    }

    if (!mundo.runtime.state.running) {
        console.log("!mundo.runtime.state.running")
        clearInterval(interval);
        interval = null;
        mensaje_final();
        highlightCurrentLine();
    }
}
function compile() {
    // if (sessionStorage) {
    //     sessionStorage.setItem('karel.js:karelsource', editor.getValue());
    //     sessionStorage.setItem('karel.js:karelworld', mundo.save());
    // }
    var syntax = getSyntax(editor.getValue());
    $('#pila').html('');
    try {
        editor.clearGutter('errors');
        var allMarks = editor.getAllMarks();
        for (var i = 0; i < allMarks.length; i++) {
            allMarks[i].clear();
        }
        var compiled = syntax.parser.parse(editor.getValue());
        if (location.hash == '#debug') {
            console.log(JSON.stringify(compiled));
        }

        console.log
        $('#pila').append('<br>Programa compilado (sintaxis ' + syntax.name + ')');
        return compiled;
    } catch (e) {

        console.log("no se pudo compilar",e)
        if (e.expected) {
            e.message = 'Error de compilación en la línea ' + (e.line + 1) +
                ': "' + e.text + '"\n' +
                'Se encontró ' + ERROR_TOKENS[syntax.name][e.token] +
                ', se esperaba uno de:';
            for (var i = 0; i < e.expected.length; i++) {
                e.message +=
                    ' ' + ERROR_TOKENS[syntax.name][e.expected[i].substring(
                    1, e.expected[i].length - 1)];
            }
        } else {
            var translations = {
                'Prototype redefinition': 'El prototipo ya había sido declarado',
                'Function redefinition': 'La función ya había sido definida',
                'Function parameter mismatch':
                    'El número de parámetros de la llamada a función no coincide con el de su declaración',
                'Prototype parameter mismatch':
                    'El número de parámetros de la función no coincide con el de su prototipo',
                'Undefined function': 'Función no definida',
                'Unknown variable': 'Variable desconocida'
            };
            if (typeof e === 'string') {
                var message = e;
                e = new Error(e);
                e.text = message.split(':')[1];
                e.line = 0;
                e.loc = {first_line: 0, last_line: 0};
                console.log(e);
            }
            var message = e.message.split(':')[0];
            e.message = 'Error de compilación en la línea ' + (e.line + 1) +
                '\n' + translations[message] + ': "' + e.text + '"';
        }
        var marker = document.createElement('div');
        marker.className = 'error';
        marker.style.position = 'relative';
        marker.innerHTML =
            '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUM2OEZDQTQ4RTU0MTFFMUEzM0VFRTM2RUY1M0RBMjYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUM2OEZDQTU4RTU0MTFFMUEzM0VFRTM2RUY1M0RBMjYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBQzY4RkNBMjhFNTQxMUUxQTMzRUVFMzZFRjUzREEyNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBQzY4RkNBMzhFNTQxMUUxQTMzRUVFMzZFRjUzREEyNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PkgXxbAAAAJbSURBVHjapFNNaBNBFH4zs5vdZLP5sQmNpT82QY209heh1ioWisaDRcSKF0WKJ0GQnrzrxasHsR6EnlrwD0TagxJabaVEpFYxLWlLSS822tr87m66ccfd2GKyVhA6MMybgfe97/vmPUQphd0sZjto9XIn9OOsvlu2nkqRzVU+6vvlzPf8W6bk8dxQ0NPbxAALgCgg2JkaQuhzQau/El0zbmUA7U0Es8v2CiYmKQJHGO1QICCLoqilMhkmurDAyapKgqItezi/USRdJqEYY4D5jCy03ht2yMkkvL91jTTX10qzyyu2hruPRN7jgbH+EOsXcMLgYiThEgAMhABW85oqy1DXdRIdvP1AHJ2acQXvDIrVHcdQNrEKNYSVMSZGMjEzIIAwDXIo+6G/FxcGnzkC3T2oMhLjre49sBB+RRcHLqdafK6sYdE/GGBwU1VpFNj0aN8pJbe+BkZyevUrvLl6Xmm0W9IuTc0DxrDNAJd5oEvI/KRsNC3bQyNjPO9yQ1YHcfj2QvfQc/5TUhJTBc2iM0U7AWDQtc1nJHvD/cfO2s7jaGkiTEfa/Ep8coLu7zmNmh8+dc5lZDuUeFAGUNA/OY6JVaypQ0vjr7XYjUvJM37vt+j1vuTK5DgVfVUoTjVe+y3/LxMxY2GgU+CSLy4cpfsYorRXuXIOi0Vt40h67uZFTdIo6nLaZcwUJWAzwNS0tBnqqKzQDnjdG/iPyZxo46HaKUpbvYkj8qYRTZsBhge+JHhZyh0x9b95JqjVJkT084kZIPwu/mPWqPgfQ5jXh2+92Ay7HedfAgwA6KDWafb4w3cAAAAASUVORK5CYII=" width="16" height="16"/><pre class="error-popup">' + e.message + '</pre>';
        editor.setGutterMarker(e.line, 'errors', marker);
        var first = {line: e.loc.first_line, ch: e.loc.first_column};
        var last = {line: e.loc.last_line, ch: e.loc.last_column};
        var options = {title: e.message, className: 'parse-error'};
        var mark = editor.markText(first, last, options);

        $('#pila').append('<br><pre>' + e + '</pre> (sintaxis ' + syntax.name + ')');
        return null;
    }
}
function mensaje_final() {
    if (mundo.runtime.state.error) {
        console.log("error")
        $('#pila').html("<br>"+ERROR_CODES[mundo.runtime.state.error]);
        return;
    }

    var conteo = '';
    if (mundo.dumps[World.DUMP_MOVE])
        conteo = conteo + ' avanza..........' +
            mundo.runtime.state.moveCount + '\n';
    if (mundo.dumps[World.DUMP_LEFT])
        conteo = conteo + ' gira-izquierda..' +
            mundo.runtime.state.turnLeftCount + '\n';
    if (mundo.dumps[World.DUMP_PICK_BUZZER])
        conteo = conteo + ' coge-zumbador...' +
            mundo.runtime.state.pickBuzzerCount + '\n';
    if (mundo.dumps[World.DUMP_LEAVE_BUZZER])
        conteo = conteo + ' deja-zumbador...' +
            mundo.runtime.state.leaveBuzzerCount;
    if (conteo != '')
        conteo = '<pre> Instrucciones ejecutadas:\n' + conteo + '</pre>';

    $('#pila').append('<br>Ejecución terminada!' + conteo);

    console.log("sin error")

    mensaje_validacion();
}
function mensaje_validacion() {
    mundo.postValidate(validatorCallbacks)
        .then(
            function (didValidation) {
                if (didValidation)
                    $(thisDom).find('#mensajes')
                        .trigger('success',
                            {'mensaje': 'La solución es correcta'});
            },
            function (message) {
                $(thisDom).find('#mensajes')
                    .trigger('error', {
                        'mensaje': 'La solución es incorrecta' +
                            (message ? ': ' + message : '')
                    });
            });
}
function recalcDimensions() {
    world.width = $("#rightPaneWorld").width();
    world.height = $("#rightPaneWorld").height();
    console.log("new dimensions", world.width, world.height)
    wRender.paint(mundo, world.width, world.height,
        {editable: mundo_editable});
}
function makeBreakpoint() {
    var marker = $(document).get(0).createElement('div');
    marker.style.color = '#822';
    marker.innerHTML = '●';
    return marker;
}

var that = this;

$(document).ready(function(){

    _world = $("#world").get(0);
    world = $("#world").get(0);

    //hack para que funcionen las parades iniciales del miundo.. ¿¿?¿ no sè por que...
    h = 100;
    w = 100;
    //fin hack

    context = world.getContext('2d');
    _wRender = new WorldRender(context, h, w, thisDom);

    wRender = _wRender;
    _mundo = new World(w, h);

    mundo = _mundo;
    addEventListeners(mundo);
    mundo_editable = true;
    linea_actual = null;
    currentCell = undefined;
    src = null;
    interval = null;


    $("#world").attr('width', $("#world").width());
    $("#world").attr('height', $("#world").height());

    $(thisDom.compilar).click(function (event) {
        compile();
        editor.focus();
    });
    $(thisDom.ejecutar).click(function (event) {
        if (mundo_editable) {
            var compiled = compile();
            if (compiled != null) {
                mundo.reset();
                mundo.runtime.load(compiled);
                mundo.preValidate(validatorCallbacks)
                    .then(function (didValidation) {
                            if (didValidation) {
                                //    en caso de qie la validacion sea exitosa
                            }
                            mundo.runtime.start();
                            interval = setInterval(step, $(thisDom).find('#retraso_txt').val());
                        },
                        function (message) {
                            //en caso de que la validaciòn falle
                            compiled = null;
                        }
                    );
            }
        } else {
            interval = setInterval(step, $(thisDom).find('#retraso_txt').val());
        }

    });
    $(thisDom.paso).click(function (event) {
        if (!mundo_editable) {
            step();
            return;
        }
        var compiled = compile();
        if (compiled != null) {
            mundo_editable = false;
            mundo.reset();
            mundo.runtime.load(compiled);
            mundo.preValidate(validatorCallbacks)
                .then(
                    function (didValidation) {
                        if (didValidation) {
                            //  en caso de que la validacio  sea exitosa
                        }
                        mundo.runtime.start();
                        step();
                    },
                    function (message) {
                        //en caso de que la validacion falle
                        compiled = null;
                    });
        }
    });

    $("#worldclean").click(function (event) {
        if (linea_actual != null) {
            editor.removeLineClass(linea_actual, 'background', 'karel-current-line');
        }
        mundo_editable = true;

        mundo.load(parseWorld(atob($("#xmlMundo").val())));


        wRender.paint(mundo, world.width, world.height,
            {editable: true, track_karel: true});

    });
    $("#world").mousemove(function (event) {
        var x = event.offsetX || (event.clientX + document.body.scrollLeft +
            document.documentElement.scrollLeft -
            $("#world").offset().left);
        var y = event.offsetY || (event.clientY + document.body.scrollTop +
            document.documentElement.scrollTop -
            $("#world").offset().top);
        var cellInfo = wRender.calculateCell(x, world.height - y);

        var changed = !((currentCell) && cellInfo.row == currentCell.row &&
            cellInfo.column == currentCell.column &&
            cellInfo.kind == currentCell.kind);
        currentCell = cellInfo;
        if (mundo_editable && changed) {
            wRender.paint(mundo, world.width, world.height,
                {editable: mundo_editable});
            if (cellInfo.kind == Kind.Corner) {
                if (wRender.polygon) {
                    wRender.polygonUpdate(cellInfo.row, cellInfo.column);
                    wRender.paint(mundo, world.width, world.height,
                        {editable: mundo_editable});
                }
                wRender.hoverCorner(cellInfo.row, cellInfo.column, world.width,
                    world.height);
            } else {
                if (cellInfo.kind == Kind.WestWall) {
                    wRender.hoverWall(cellInfo.row, cellInfo.column, 0,
                        world.width, world.height);  // oeste
                } else if (cellInfo.kind == Kind.SouthWall) {
                    wRender.hoverWall(cellInfo.row, cellInfo.column, 3,
                        world.width, world.height);  // sur
                } else if (cellInfo.kind == Kind.Beeper) {
                    wRender.hoverBuzzer(cellInfo.row, cellInfo.column,
                        world.width, world.height);
                }
            }
        }
    });
    $("#world").get(0).onmousewheel = function (event) {
        if (event.wheelDeltaX < 0 &&
            (wRender.primera_columna + wRender.num_columnas) < w + 2) {
            wRender.primera_columna += 1;
        } else if (event.wheelDeltaX > 0 && wRender.primera_columna > 1) {
            wRender.primera_columna -= 1;
        }

        if (event.wheelDeltaY > 0 &&
            (wRender.primera_fila + wRender.num_filas) < h + 2) {
            wRender.primera_fila += 1;
        } else if (event.wheelDeltaY < 0 && wRender.primera_fila > 1) {
            wRender.primera_fila -= 1;
        }

        wRender.paint(mundo, world.width, world.height,
            {editable: mundo_editable});
        return false;
    };
    $("#world").hammer().on('drag', function (event) {
        var x = event.gesture.deltaX % 2;
        var y = event.gesture.deltaY % 2;
        if (event.gesture.deltaX < 0 && (wRender.primera_columna + wRender.num_columnas) < w + 2 && x == 0) {
            wRender.primera_columna += 1;
        } else if (event.gesture.deltaX > 0 &&
            wRender.primera_columna > 1 && x == 0) {
            wRender.primera_columna -= 1;
        }
        if (event.gesture.deltaY > 0 && (wRender.primera_fila + wRender.num_filas) < h + 2 && y == 0) {
            wRender.primera_fila += 1;
        } else if (event.gesture.deltaY < 0 && wRender.primera_fila > 1 && y == 0) {
            wRender.primera_fila -= 1;
        }
        wRender.paint(mundo, world.width, world.height,
            {editable: mundo_editable});
    });
    $("#world").hammer().on('release', function (event) {
        event.gesture.preventDefault();
    });
    $("#world").on('mouseup', function (event) {
        event.preventDefault();
    });
    Hammer($("#world")).on('dragstart', function (event) {
        $(document.body).css('cursor', 'move');
    });
    Hammer($("#world")).on('dragend', function (event) {
        $(document.body).css('cursor', 'auto');
        currentCell = undefined;
    });


    /***
        * HACK ESPECIAL: PARA QUE SE VEA EL MUNDO CORRECTAMENTE A LA PRIMERA
        */
    var recalcDimensionsIntervalSizeChange = setInterval(function () {
        var h1 = $("#rightPaneWorld").height();
        var w1 = $("#rightPaneWorld").width();
        if (h1 !== h || w1 !== w) {
            h = h1;
            w = w1;
            recalcDimensions()
        }
    }, 10);


    // Expone varias cosas para que puedan ser accedidas desde las pruebas.
    if (window) {
        window.state = {
            mundo: mundo,
            editor: editor,

            init: function (world, code) {
                $('script#xmlMundo').html(world);
                editor.setValue(code);
                $('#worldclean').click();
            },
            cleanLog: function () {
                $('#mensajes')
                    .empty();
            },
        };
    }

    var a = setInterval(function () {
        if (_mundo !== null) {
            var mundo = atob($("#xmlMundo").val());
            _mundo.load(parseWorld(mundo));
            console.log(mundo);
            _wRender.paint(_mundo, _world.width, _world.height,
                {editable: true, track_karel: true});
            clearInterval(a);
        }
    }, 50);

});

