
// Initialize Firebase with your project config
var firebaseConfig = {
    apiKey: "AIzaSyAj2EMSoi-M8Z7SF52P23A98jPTf6r2Zpk",
    authDomain: "course-scheduler-b4f7e.firebaseapp.com",
    databaseURL: "https://course-scheduler-b4f7e-default-rtdb.firebaseio.com",
    projectId: "course-scheduler-b4f7e",
    storageBucket: "course-scheduler-b4f7e.appspot.com",
    messagingSenderId: "334389325155",
    appId: "1:334389325155:web:8f42d91a5bd7e9120fb756",
    measurementId: "G-1S979YX5DB"
};

firebase.initializeApp(firebaseConfig);
var database = firebase.database();

// Your existing JavaScript functions

function addToDB() {
    // Function to handle form submission and send data to Firebase
    var table = document.getElementById("dynamic-table");
    // https://developer.mozilla.org/en-US/docs/Web/API/Element/getElementsByTagName
    var rows = table.getElementsByTagName("tr");

    // Skip first title row
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        // https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector
        var courseID = cells[6].querySelector("select").value;

        if (courseID !== 'empty') {
            var className = cells[1].querySelector("input").value;
            var abbreviation = cells[2].querySelector("input").value;
            var contactHours = cells[3].querySelector("select").value;
            var sections = cells[4].querySelector("input").value;
            // TODO need to fix checkbox
            // var unavailableTimes: {
            //     monday = cells[5].querySelector("input[name='monday']").checked,
            //     tuesday = cells[5].querySelector("input[name='tuesday']").checked,
            //     wednesday = cells[5].querySelector("input[name='wednesday']").checked,
            //     thursday = cells[5].querySelector("input[name='thursday']").checked,
            //     friday = cells[5].querySelector("input[name='friday']").checked
            // };

            // Push data to Firebase and map data to Firebase using CourseID as key
            database.ref('courses/' + courseID).set({
               class_name: className,
                abbreviation: abbreviation,
                contact_hours: contactHours,
                sections: sections,
                //unavailableTimes: unavailableTimes
            });   
            // TODO remove this make a better message       
            alert("It worked!");
        }
    }
}