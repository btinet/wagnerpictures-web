/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import {Tooltip, ScrollSpy} from 'bootstrap';
import Core from "./app/core";

const App = new Core();
let linkButtons = App.findBy('.like-button');
let isCompany = App.findOneBy('#is_company');
let companyFieldset = App.findOneBy('#company_name_fieldset');

let $buttons = document.querySelectorAll('.disabled')

// Loop over them and prevent submission
Array.prototype.slice.call($buttons)
    .forEach(function ($button) {
        $button.setAttribute("disabled","disabled");
    })

if(isCompany){
    isCompany.addEventListener ('click', function (evt) {
        if(isCompany.checked){
            companyFieldset.style.display ="grid";
            console.log('checked');
        } else {
            companyFieldset.style.display ="none";
            console.log('not checked');
        }
    });
}


App.form.submitOn(App.findBy('.filter_form'),'change')

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new Tooltip(tooltipTriggerEl)
})


    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })



createLinkAction(linkButtons,setLike,'href','data-value')

function createLinkAction(elements,customFunction,attribute,id, eventAction = "click"){
    Array.prototype.slice.call(elements)
        .forEach(function (element) {

            let link = App.getAttribute(element,attribute);
            let value = App.getAttribute(element,id);

            element.addEventListener(eventAction,function(e) {
                e.preventDefault();
                    customFunction(link,value);
                },
                false)
        })
}

function loadPage(link) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        App.findOneBy('#sample_items').innerHTML = this.responseText;
    }
    xhttp.open("POST", link);
    xhttp.send();
    return null
}

function setLike(link, value){
    let likeIcon = App.findOneBy('.like-icon-'+value);
    let likeLoader = App.findOneBy('.like-loader-'+value);
    App.setClass(likeIcon,'d-none');
    App.setClass(likeLoader,'d-none',true);
    let data = {};
    data.id = value;
    let json = JSON.stringify(data);
    let xhr = new XMLHttpRequest();
    xhr.open('post', link,true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            App.setClass(likeIcon,'d-none',true);
            App.setClass(likeLoader,'d-none');
            if(response.sampleHasLike)
            {
                App.setClass(likeIcon,'bi-heart-fill');
                App.setClass(likeIcon,'bi-heart',true);
            } else {
                App.setClass(likeIcon,'bi-heart');
                App.setClass(likeIcon,'bi-heart-fill',true);
            }
            App.findOneBy('.like-number-'+value).innerHTML = response.likes;

        }
    };
    xhr.send(json);
}

let $formInputFields = document.querySelectorAll('.input-comment');

Array.prototype.slice.call($formInputFields)
    .forEach(function ($field) {
        let $i = 0;
        addMultipleEventListener($field,['keyup','change','cut','click','focus'],validateForm)
    })

function addMultipleEventListener(element, events, handler) {
    events.forEach(e => element.addEventListener(e, handler))
}

function validateForm($i){
            let submitButton = App.findOneBy('#submit_'+App.getAttribute(this,'name'));
            if(this.value === "" && this.hasAttribute('required')){
                $i = 1;
            }
            if($i === 1){
                submitButton.classList.add('disabled');
            } else {
                submitButton.classList.remove('disabled');
                submitButton.removeAttribute('disabled');
            }

}

let addItemLinks = App.findBy('.add_item_link');

Array.prototype.slice.call(addItemLinks)
    .forEach(function (element) {
        element.addEventListener('click',function(e) {
                addFormToCollection(e);
            },
            false)
    })

const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    console.log(collectionHolder);
    const item = document.createElement('li');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
};