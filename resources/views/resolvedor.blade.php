<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="/kareljs/css/custom.css?v=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        body {
            padding: 5px;
            background: url('/images/cream_pixels.png');
        }

        .card-header {
            background: #4f39a5;
            color: white;
        }

        .btn {
            margin: 5px;
            background: #4f39a5;
            color: white !important;
            height: 40px;

        }

        .btn-primary {
            border-color: #4f39a5;
        }

        .card-header {
            padding: 1px;
        }
    </style>
</head>

<body>

    <div id="app">

        <div style="height:45px;">
            <div style="display:flex;flex-direction: row;">
                <button class="btn  btn-primary" id="worldclean" title="Regresar el mundo a su estado original">
                    Reiniciar
                </button>
                <button class="btn  btn-primary" id="compilar" title="Compilar">
                    Compilar
                </button>
                <button class="btn  btn-primary" id="ejecutar" title="Ejecutar">
                    Ejecutar
                </button>
                <button class="btn  btn-primary" id="paso" title="Paso a paso">
                    Siguiente
                </button>

                <button theme="secondary contrast  small" class="btn" id="go_home" title="Volver a 1,1"><em class="icon-home"></em></button>
                <button theme="secondary contrast  small" class="btn" id="follow_karel" title="Ve a donde esté Karel"><em class="icon-arrow-up"></em></button>
                <div class="input-prepend input-append" style="height:100%;">
                    <span class="add-on" title="El número de zumbadores en la mochila con los que inicia Karel" style="height:100%;">Mochila</span>
                    <input class="span1" id="mochila" type="text" value="0" style="height:100%;" readonly>
                </div>

                <button theme="primary success small" v-on:click="enviarSolucion" class="btn  btn-primary pull-right">
                    <iron-icon icon="lumo:arrow-up" slot="prefix"></iron-icon>
                    Enviar
                </button>


                <div style="margin-left:30px;">
                    @include("infoheader")
                </div>
                <div>
                    <span v-if="tiempoRestante!==null">
                        {(tiempoRestante.hours)} horas, {(tiempoRestante.minutes)} minutos, {(tiempoRestante.seconds)} segundos,
                    </span>
                </div>
            </div>

        </div>
        <hr>
        <div style="height:calc(100vh - 100px); ">
            <div style="height:100%;display:flex;">
                <div id="" style="width:30%; display:flex;flex-direction:column;padding:5px;resize:both;overflow:auto;">
                    <div class="card"  style="overflow:auto;height:70%;">
                        <div class="card-header">
                            Descripción
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$problema->nombre}}</h5>
                            <p class="card-text">
                                {!!$problema->descripcion!!}
                            </p>
                        </div>
                    </div>
                    <div class="card"  style="overflow:auto;height:30%">
                        <div class="card-header">
                            Herramientas
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <button class="btn  btn-primary" @click="setCodeOneLine('move();')">move</button>
                                <button class="btn  btn-primary" @click="setCodeOneLine('putbeeper();')">putbeeper</button>
                                <button class="btn  btn-primary" @click="setCodeOneLine('pickbeeper();')">pickbeeper</button>
                                <button class="btn  btn-primary" @click="setCodeOneLine('turnleft();')">turnleft</button>

                                <button class="btn  btn-primary" @click="setStructureWithFunction('iterate','')">iterate</button>

                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('')">if else</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('frontIsClear()')">if frontIsClear</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('frontIsBlocked()')">if frontIsBlocked</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('leftIsClear()')">if leftIsClear</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('leftIsBlocked()')">if leftIsBlocked</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('rightIsClear()')">if rightIsClear</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('rightIsBlocked()')">if rightIsBlocked</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('nextToABeeper()')">if nextToABeeper</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('notNextToABeeper()')">if notNextToABeeper</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('anyBeepersInBeeperBag()')">if anyBeepersInBeeperBag</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('noBeepersInBeeperBag()')">if noBeepersInBeeperBag</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('facingNorth()')">if facingNorth</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('facingSouth()')">if facingSouth</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('facingEast()')">if facingEast</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('facingWest()')">if facingWest</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('notFacingNorth()')">if notFacingNorth</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('notFacingSouth()')">if notFacingSouth</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('notFacingEast()')">if notFacingEast</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('notFacingWest()')">if notFacingWest</button>
                                <button class="btn  btn-primary" @click="setIfElseStructureWithFunction('anyBeepersInBeeperBag()')">if anyBeepersInBeeperBag</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','')">while</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','frontIsClear()')">while frontIsClear</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','frontIsBlocked()')">while frontIsBlocked</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','leftIsClear()')">while leftIsClear</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','leftIsBlocked()')">while leftIsBlocked</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','rightIsClear()')">while rightIsClear</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','rightIsBlocked()')">while rightIsBlocked</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','nextToABeeper()')">while nextToABeeper</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','notNextToABeeper()')">while notNextToABeeper</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','anyBeepersInBeeperBag()')">while anyBeepersInBeeperBag</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','noBeepersInBeeperBag()')">while noBeepersInBeeperBag</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','facingNorth()')">while facingNorth</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','facingSouth()')">while facingSouth</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','facingEast()')">while facingEast</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','facingWest()')">while facingWest</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','notFacingNorth()')">while notFacingNorth</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','notFacingSouth()')">while notFacingSouth</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','notFacingEast()')">while notFacingEast</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','notFacingWest()')">while notFacingWest</button>
                                <button class="btn  btn-primary" @click="setStructureWithFunction('while','anyBeepersInBeeperBag()')">while anyBeepersInBeeperBag</button>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="leftPaneCode" style="width: 30%; display:flex;flex-direction:column;padding:5px;resize:both;overflow:auto;">

                    <div orientation="vertical" style="height:100%;">

                        <div class="card" style="height:100%;">
                            <div class="card-header">
                                Código
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <div style="height:70%">
                                        <textarea id="editor">{{trim(str_replace('	','    ',$ultimoCodigo))}}</textarea>
                                    </div>
                                    <div style="height:30%;display:flex;flex-direction:column;">
                                        <div id="" style="background:gray;color:white;font-size:11px;text-align:center;">
                                            Mensajes de Karel
                                        </div>
                                        <div id="pila" style="flex-grow:1;padding:5px;font-size:12px;">

                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="rightPaneWorld" style="width:40%;">
                    <canvas id="world"></canvas>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" v-bind:style="{'display':showModal ? 'block' : 'none'}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Felicidades</h5>

                    </div>
                    <div class="modal-body">
                        <p>Has obtenido {(casosResueltos/totalCasos*100)}% con un total de {(casosResueltos/totalCasos * puntos)} </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="showModal = false">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" value="{{base64_encode($mundoInicial)}}" id="xmlMundo">
    </div>


    {{-- <script src="/kareljs/lib/CodeMirror/lib/codemirror.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.3/codemirror.min.js" integrity="sha512-hGVnilhYD74EGnPbzyvje74/Urjrg5LSNGx0ARG1Ucqyiaz+lFvtsXk/1jCwT9/giXP0qoXSlVDjxNxjLvmqAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="/kareljs/lib/CodeMirror/mode/javascript/javascript.js"></script> --}}
    <script src="/kareljs/lib/CodeMirror/addon/selection/active-line.js"></script>
    <script src="/kareljs/lib/CodeMirror/addon/fold/foldcode.js"></script>
    <script src="/kareljs/lib/CodeMirror/addon/fold/foldgutter.js"></script>
    <script src="/kareljs/lib/CodeMirror/addon/fold/indent-fold.js"></script>
    {{-- <script src="/kareljs/lib/CodeMirror/addon/mode/overlay.js"></script> --}}
    <script src="/kareljs/lib/jquery-1.12.0.min.js"></script>
    <script src="/kareljs/lib/jquery.hammer.js"></script>
    <script src="/kareljs/lib/jquery.sandbox.js"></script>
    <script src="/kareljs/lib/bootstrap.min.js"></script>
    <script src="/kareljs/lib/Split.js/split.js"></script>
    <script src="/kareljs/js/syntax.js"></script>
    <script src="/kareljs/js/karel.js"></script>
    <script src="/kareljs/js/mundo.js"></script>
    <script src="/kareljs/js/karelruby.js"></script>
    <script src="/kareljs/js/kareljava.js"></script>
    <script src="/kareljs/js/karelpascal.js"></script>

    <script src="/kareljs/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>



    <script>

        console.log('hola')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#enviar-solucion2").on('click', function() {

        });




        var app = new Vue({
            el: '#app',
            delimiters: ['{(', ')}'],
            data: {
                showModal: false,
                tiempoRestante: null,
                problemaId: {{$problemaId}},
                totalCasos: null,
                casosResueltos: null,
                puntos: {{$problema->puntos}},
                puntosObtenidos: null
            },
            mounted: function() {
                let that = this;
                window.setInterval(function() {
                    $.get("/examenes/tiempo-restante/problema/" + that.problemaId).then(function(data) {
                        that.tiempoRestante = data;

                        if(data.hours===0 && data.minutes===0 && data.seconds === 0) {
                            window.location.reload();
                        }
                        console.log(data)
                    })
                }, 1000)



            },
            methods: {

                setCodeOneLine(code) {
                    editor.focus()
                    let cursor = editor.getCursor();
                    let final = code;
                    editor.replaceSelection(final);

                    cursor.ch = cursor.ch + code.length;

                    editor.setCursor(cursor)
                },
                setStructureWithFunction(name,func) {
                    editor.focus()
                    let cursor = editor.getCursor();
                    console.log(cursor)
                    let indentPrevious = ' '.repeat(cursor.ch);
                    let indent = ' '.repeat(4);
                    let emptyLineWithNewIndent = indentPrevious+indent;
                    let final = name+'('+func+') {\n'+emptyLineWithNewIndent+'\n'+indentPrevious+'}';
                    editor.replaceSelection(final);

                    cursor.ch = emptyLineWithNewIndent.length;
                    cursor.line++;

                    editor.setCursor(cursor)

                },

                setIfElseStructureWithFunction(func) {
                    editor.focus()
                    let cursor = editor.getCursor();
                    console.log(cursor)
                    let indentPrevious = ' '.repeat(cursor.ch);
                    let indent = ' '.repeat(4);
                    let emptyLineWithNewIndent = indentPrevious+indent;
                    let final = 'if('+func+') {\n'+emptyLineWithNewIndent+'\n'+indentPrevious+'}\n'+indentPrevious+'else {\n'+emptyLineWithNewIndent+'\n'+indentPrevious+'}';
                    editor.replaceSelection(final);


                    cursor.ch = emptyLineWithNewIndent.length;
                    cursor.line++;

                    editor.setCursor(cursor)
                },

                enviarSolucion: function() {
                    let that = this;
                    console.log("holi")
                    $.post("/resolver/evaluar", {
                        problema_id: this.problemaId,
                        solucion: editor.getValue()
                    }).then(function(data) {
                        that.totalCasos = data.total_casos;
                        that.casosResueltos = data.total_casos_resueltos;
                        that.showModal = true;
                    })
                }
            }
        })

        var that = this;
    </script>



</body>

</html>
