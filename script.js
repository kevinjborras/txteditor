var editor, dir, folder, doc, saved;
var keys= {};

function load() {
    editor = ace.edit("editor")
    openFolder("..");

    document.addEventListener("keydown", function(event) {
        if (event.ctrlKey && event.key === "s") {
          event.preventDefault(); // Quita el default de "guardar como"
          console.log("fasfas")
          save(); 
        }
      });

    window.addEventListener("keyup", function(event) {delete keys[event.key];});
    //Para mostrar el boton de guerdado
}

function post(url, data, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          callback(this.responseText);
        }
    };

    xhr.open("POST", 'php/' + url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (typeof data === "object") {
        var newObj = "";
        for(var i in data) {
            newObj += i + '=' + data[i];
            if(Object.keys(data).indexOf(i) !== Object.keys(data).length-1) {
                newObj += "&"
            }

        }
        data = newObj;
    }
    xhr.send(encodeURI(data));    
}

function openFolder(folder) {
    post ("dir.php", {folder:folder}, function(data){
        document.getElementById('files').innerHTML = data;
    });
}

function openFile (file) {
    post("file.php", {file:file}, function(data) {
        doc = file;
        saved = data;
        //document.getElementById("file").textContent = doc.split('/').pop();
        editor.setValue(data, -1);
    });
}

function save() {

    post("save.php", {file:doc,code: editor.getValue()}, function(data) {
        if(data === 'true') {
            alert("Archivo Guardado");  
            saved = editor.getValue();
            checkSave();
        }
        else {
            console.log(data);
        }
    });
}

function newFile() {
    var filename = prompt("Introduce el nombre del archivo");
    
    post("newFile.php", {filename, dir}, function(data) {
        if (data = true) {
            openFolder(dir);
        }
        else {
            console.log(data);
        }
    })
}
