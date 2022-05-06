/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var UIToastr = function () {
    return {
        //main function to initiate the module
        init: function (type, title, description) {
            var i = -1, toastCount = 0, $toastlast;
            $(document).ready(function () {
                var toastIndex = toastCount++;
                toastr.options = {
                    closeButton: $('#closeButton').prop('checked'),
                    debug: $('#debugInfo').prop('checked'),
                    positionClass: $('#positionGroup input:checked').val() || 'toast-top-right',
                    onclick: null
                };

                var $toast = toastr[type](title, description); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                if ($toast.find('#okBtn').length) {
                    $toast.delegate('#okBtn', 'click', function () {
                        alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                        $toast.remove();
                    });
                }
                if ($toast.find('#surpriseBtn').length) {
                    $toast.delegate('#surpriseBtn', 'click', function () {
                        alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                    });
                }

                $('#clearlasttoast').click(function () {
                    toastr.clear($toastlast);
                });
            });
            $('#cleartoasts').click(function () {
                toastr.clear();
            });
        }
    };
}();

var UIConfirmations = function () {

    var handleSample = function () {

        $('.delConfirm').on('confirmed.bs.confirmation', function () {
            alert(1);
            return false;
        });

        $('.delConfirm').on('canceled.bs.confirmation', function () {
            return false;
        });


    }


    return {
        //main function to initiate the module
        init: function () {

            handleSample();

        }

    };

}();

jQuery(document).ready(function () {
    UIConfirmations.init();
});
