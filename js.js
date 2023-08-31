
var btn = document.querySelectorAll('.showPassword');
var inputPass = document.querySelectorAll('.password');

for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', function () {
        var olhinho = document.querySelectorAll(".olhinho");
        if (inputPass[i].getAttribute('type') == 'password') {
            olhinho[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 18 18"><path d = "M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" /><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" /><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" /></svg > '
            inputPass[i].setAttribute('type', 'text');
        } else {
            inputPass[i].setAttribute('type', 'password');
            olhinho[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-eye" viewBox="0 0 18 18"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" /><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" /></svg>'
        }
    });
}

var value = document.querySelector('#range');
var input = document.querySelector('#range-inp');
value.textContent = input.value;
input.addEventListener("input", (event) => {
    value.textContent = event.target.value;
})

String.prototype.shuffle = function () {
    var a = this.split(""),
        n = a.length;

    for (var i = n - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var tmp = a[i];
        a[i] = a[j];
        a[j] = tmp;
    }
    return a.join("");
}

var passShu = document.querySelector('.passShuffle');
const abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
const num = "0123456789";
const crc = "!#$%&'()*+,-./:;<=>?@[]^_`{|}~";

passShu.addEventListener('click', function () {
    var x = '';
    x = abc + num + crc;
    var y = parseInt(value.textContent);
    var z = x.shuffle();
    console.log(z.substring(0, y));
    for (let i = 0; i < inputPass.length; i++) {
        inputPass[i].value = (z.substring(0, y));
    }
});

const ul = document.querySelector('#css-tags');
const inputTag = document.querySelector('#css-inpTag');

const itemsList = [];

inputTag.addEventListener("keydown", (e) => {
    if (e.code.includes("Enter") && e.target.value) {
        itemsList.push(e.target.value);
        inputTag.value = "";

        loadItems();
    }
})

function loadItems() {
    ul.innerHTML = "";

    itemsList.forEach((item, i) => {
        const li = document.createElement("li");

        li.innerHTML = `
        <div>
            <span>$item</span>
            <button onclick = "removeItem(${i})">X</button>
        </div>
        `;

        ul.appendChild(li);
    })
}

function removeItem(i) {
    itemsList.splice(i, 1);
    loadItems();
}






const tagUl = document.querySelector("ul"),
input = document.querySelector("input"),
tagNumb = document.querySelector(".details span");

let maxTags = 10,
tags = ["coding", "nepal"];

countTags();
createTag();

function countTags(){
    input.focus();
    tagNumb.innerText = maxTags - tags.length;
}

function createTag(){
    tagUl.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag =>{
        let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
        tagUl.insertAdjacentHTML("afterbegin", liTag);
    });
    countTags();
}

function remove(element, tag){
    let index  = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTags();
}

function addTag(e){
    if(e.key == "Enter"){
        let tag = e.target.value.replace(/\s+/g, ' ');
        if(tag.length > 1 && !tags.includes(tag)){
            if(tags.length < 10){
                tag.split(',').forEach(tag => {
                    tags.push(tag);
                    createTag();
                });
            }
        }
        e.target.value = "";
    }
}

input.addEventListener("keyup", addTag);

const removeBtn = document.querySelector(".details button");
removeBtn.addEventListener("click", () =>{
    tags.length = 0;
    tagUl.querySelectorAll("li").forEach(li => li.remove());
    countTags();
});