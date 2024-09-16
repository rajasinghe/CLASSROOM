const startYear = 2018;
const endYear = 2034;
const thisYear = new Date().getFullYear();
console.log(thisYear);
let options = "";

for (let year = startYear ; year <= endYear ; year++) {
    if (year != thisYear) {
        options += "<option>"+year+"</option>"; 
    } else {
        options += "<option selected>"+year+"</option>";      
    }
}
document.getElementById("year").innerHTML = options;