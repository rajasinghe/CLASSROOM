// Stores information about the calendar status( example :- corrunt month , year)
let currentDate = new Date();
let calendarSelectedDate = new Date();

const dateListener = () => {
    let listItems = document.querySelectorAll('.calendar-body .body-body li');
    for (const li of listItems) {
        li.addEventListener('click', event => {
            // Add styles to the clicked item
            li.classList.add('selected');

            // Remove styles from every other item
            listItems.forEach(element => {
                if(element !== li){
                    element.classList.remove('selected');
                }
            });
        });
    }
}

function refreshListeners(){
    generateCalendarBody(calendarSelectedDate);
    dateListener();
    document.querySelector('#next-btn').addEventListener('click', event => {
        calendarSelectedDate.setMonth(calendarSelectedDate.getMonth() + 1);
    
        generateCalendarBody(calendarSelectedDate);
    });
    
    document.querySelector('#pre-btn').addEventListener('click', event => {
        calendarSelectedDate.setMonth(calendarSelectedDate.getMonth() - 1);
    
        generateCalendarBody(calendarSelectedDate);
    });
}

function generateCalendarBody(selectedDate){
    // Make a request to the back end and get the holidays for this month
    //TODO: put the fetch request to a seperate function and call this function in the then callback
    let y = selectedDate.getFullYear();
    let m = selectedDate.getMonth();
    selectedDate.setDate(1);
    
    let tempDate = new Date(selectedDate);
    tempDate.setMonth(tempDate.getMonth() -1, 0);
    let numOfDays = tempDate.getDate();

    let dayOfWeek = selectedDate.getDay();
    dayOfWeek = (dayOfWeek < 1)? 7:dayOfWeek;

    console.log( y + ' ' + m + ' ' + numOfDays + ' Day of the week' + dayOfWeek);

    // Template for the calendar body
    let template = ``;

    for (let index = 0; index < (dayOfWeek - 1); index++) {
        template += `<li></li>`;
    }

    for (let index = 1; index <= numOfDays; index++) {

        if(currentDate.getFullYear() === y && currentDate.getMonth() === m && currentDate.getDate() === index){
            template +=`<li class="today">${index}</li>`;
        }
        else if(false){
            // Change the styles if it's a holiday
        }
        else{
            template +=`<li>${index}</li>`;
        }
    }
    
    document.querySelector('#calendar-dates').innerHTML = template;

    m = selectedDate.toLocaleString('en-US', {month: 'long'});
    document.querySelector('.calendar-title').innerText = m + ' ' + y;
    dateListener();
}

export {};