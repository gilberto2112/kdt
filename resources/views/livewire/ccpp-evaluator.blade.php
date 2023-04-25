<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluador C/C++</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        html,body {
            margin:0;
            padding:0;
        }
        .split {
            display: flex;
            height: 100%;
            border: 1px solid black;
        }
        .split > :nth-child(1) {
            overflow: scroll;
        }
        .split > :nth-child(2) {
            flex-grow: 1;
        }
        /* Vertical */
        .split.vertical {
            flex-direction: column;
        }
        .split.vertical > :nth-child(1) {
            resize: vertical;
        }
        /* Horizontal */
        .split.horizontal {
            flex-direction: row;
        }
        .split.horizontal > :nth-child(1) {
            resize: horizontal;
        }
        .split .dotted {
            padding: 5px;
            border: 1px dashed black;
        }
    </style>
</head>
<body>
<div id="app" class="split horizontal" style="height:100vh;">
    <div style="width:500px;">
        <div style="padding:10px;">
            {!! $problema->descripcion !!}
        </div>

    </div>
    <div class="split vertical" >
        <div style="height:70%;" >
            <div id="editor" style="height:calc(100% - 40px);">{{$ultimoCodigo}}</div>
            <div style="height:40px;">
                <button id="evaluarBtn" v-on:click="ejecutar">Ejecutar</button>
                <button id="evaluarBtn" v-on:click="evaluar">Evaluar</button>
            </div>
        </div>
        <div >
            <div class="split horizontal" style="height:100%;">
                <div style="width:50%;height:100%;padding:5px;">
                    <div style="height:30px;">
                        Input
                    </div>
                    <textarea v-model="input" style="width:100%;height:calc(100% - 30px);"></textarea>
                </div>
                <div  style="width:50%;height:100%;padding:5px;">
                    <div style="height:30px;">
                        Output
                    </div>
                    <div>
                    <pre>{(output)}</pre>
                    </div>
                    <div style="height:30px;">
                        Compilación
                    </div>
                    <div>
                    <pre>{(compileOutput)}</pre>
                    </div>
                </div>
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
                    <p>Has obtenido {(resultados.puntos_obtenidos)}/{(resultados.puntos_problema)} puntos </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="showModal = false">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>

{{-- <script src="https://pagecdn.io/lib/ace/1.4.12/ace.js" crossorigin="anonymous" integrity="sha256-T5QdmsCQO5z8tBAXMrCZ4f3RX8wVdiA0Fu17FGnU1vU=" ></script> --}}
<script src="/js/ace.js"></script>
<script src="/js/theme-monokai.js"  ></script>
<script src="/js/mode-c_cpp.js"></script>

<script>


    var app = new Vue({
        el: '#app',
        delimiters: ['{(', ')}'],
        data: {
            showModal: false,
            editor: null,
            input: "",
            output: "",
            compileOutput: null,
            resultados: {}
        },
        mounted: function() {
            this.editor = ace.edit("editor");
            this.editor.session.setMode("ace/mode/c_cpp");
            this.editor.session.on('change', function(delta) {

            });

        },
        methods: {
            evaluar: function() {
                var that = this;

                console.log(this.editor.getValue())
                axios.post('/evaluar-ccpp',{
                    problema_id: {{$problema->id}},
                    solucion: this.editor.getValue()
                }).then(function(data){
                    that.resultados = data.data;
                    that.showModal = true;
                })
            },
            ejecutar: function() {
                var that = this;
                console.log(this.editor.getValue())
                axios.post('/ejecutar-ccpp',{
                    problema_id: {{$problema->id}},
                    solucion: this.editor.getValue(),
                    input: this.input
                }).then(function(data){
                    that.output = data.data.output;
                    if(data.data.compile_output){
                        that.compileOutput = atob(data.data.compile_output)
                    }
                })
            }
        }
    })




</script>
</body>
</html>
