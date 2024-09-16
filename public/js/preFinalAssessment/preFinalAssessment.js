import * as preAssessment from '/public/js/PreFinalAssessment/preAssessment.js';
import * as preAssessmentMark from '/public/js/PreFinalAssessment/preAssessmentMarkResults.js';

//load the template based on the button click  using the getIncludes in pages controller
let batchId = null;

let preAssessmentBtn;
let markPreAssessmentBtn;
let finalAssessmentBtn;
let MarkFinalAssessmentBtn;
let btns;
let preAssessmentContainer;

function refreshListener() {

    preAssessmentBtn=document.getElementById('preAssessmentBtn');
    markPreAssessmentBtn=document.getElementById('markPreAssessmentBtn');
    finalAssessmentBtn=document.getElementById('finalAssessmentBtn');
    MarkFinalAssessmentBtn=document.getElementById('MarkFinalAssessmentBtn');
    btns=document.querySelectorAll('.link-btn-preassessment');
    preAssessmentContainer =document.getElementById('preAssessment-content-container');
    
    batchId = window.selectedBatch;
    console.log(batchId);

    preAssessment.getContent(preAssessmentContainer);

    preAssessmentBtn.addEventListener('click',(e)=>{
        changeActiveLink(e);
        preAssessment.getContent(preAssessmentContainer);
    })

    markPreAssessmentBtn.addEventListener('click',(e)=>{
        changeActiveLink(e);
        preAssessmentMark.getContent(preAssessmentContainer);

    })

    finalAssessmentBtn.addEventListener('click',(e)=>{
        //changeActiveLink(e);
        //setContent('finalAssessment');

    })

    MarkFinalAssessmentBtn.addEventListener('click',(e)=>{
        //changeActiveLink(e);
        //setContent('markPreAssessment');
    })

}

function getContent(route) {
    console.log('working');
    //if(container !== null) return;
    let template = 
    `<div class="col-12 pt-4 px-2 px-md-4 d-flex">
      <span class="" id="assessment-nav">
        <button class="btn py-1 active link-btn-preassessment" id="preAssessmentBtn">Pre Assessment</button>
        <button class="btn py-1 link-btn-preassessment" id="markPreAssessmentBtn">Mark Pre Assessment</button>
        <button class="btn py-1 link-btn-preassessment" id="finalAssessmentBtn">Final Assessment</button>
        <button class="btn py-1 link-btn-preassessment" id="MarkFinalAssessmentBtn">Mark Final Assessment</button>
      </span>
    </div>
            
    <div class="col-12 pt-4 pb-4 px-md-4" id="preAssessment-content-container">
      
    </div>`;

    document.querySelector('#page-content .row').innerHTML = template;

    refreshListener();
    refreshBaseScript();
}

function changeActiveLink(e){
    btns.forEach(
        (element)=>{
            element.classList.remove('active');
        }
    )
    e.target.classList.add('active')

}

export {
    refreshListener,
    getContent
};
