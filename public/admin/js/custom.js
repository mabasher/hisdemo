function ageCalculator(birth) {  
 
    var dob = new Date(birth);  
    var dobYear = dob.getYear();  
    var dobMonth = dob.getMonth();  
    var dobDate = dob.getDate();  
      
    var now = new Date();  
    var currentYear = now.getYear();  
    var currentMonth = now.getMonth();  
    var currentDate = now.getDate();  
      
    var age = {};  
    var ageString = "";  
    
    yearAge = currentYear - dobYear;  
          
    if (currentMonth >= dobMonth)  
      var monthAge = currentMonth - dobMonth;  
    else {  
      yearAge--;  
      var monthAge = 12 + currentMonth - dobMonth;  
    }  
      
    if (currentDate >= dobDate)  
      var dateAge = currentDate - dobDate;  
    else {  
      monthAge--;  
      var dateAge = 31 + currentDate - dobDate;  
   
      if (monthAge < 0) {  
        monthAge = 11;  
        yearAge--;  
      }  
    }
   
    age = {  
    years: yearAge,  
    months: monthAge,  
    days: dateAge  
    };  
    
    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )  
       ageString = age.years + " Y " + age.months + " M " + age.days + " D";  
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )  
       ageString = "" + age.days + " D ";  
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )  
       ageString = age.years +  " years old. Happy Birthday!!";  
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )  
       ageString = age.years + " Y " + age.months + " M ";  
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )  
       ageString = age.months + " M " + age.days + " D ";  
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )  
       ageString = age.years + " Y " + age.days + " D";  
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )  
       ageString = age.months + " M ";  
    else ageString = "Welcome to Earth!";   
    
    return ageString;
   
   }