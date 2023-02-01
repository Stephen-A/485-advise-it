//print form on page
function print() {
    let printForm = window.open("print-student-plan.php", "_blank");

    // Wait for page to load before printing
    $($(printForm).on('load', function() { // SOURCE: https://stackoverflow.com/questions/6460630/close-window-automatically-after-printing-dialog-closes#:~:text=open()%3B%20...-,window.,and%20close()%20the%20window.
            printForm.onafterprint = window.close;
            printForm.print();
        })
    );
}
