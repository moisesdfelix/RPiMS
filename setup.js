var tlspskidentityid = "TLSPSKIdentity";
var tlspskid = "TLSPSK";

/* Function to generate combination of PSK */
function generateP(lenght) {
        var pass = '';
        var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
                    'abcdefghijklmnopqrstuvwxyz0123456789';
        for (i = 1; i <= lenght; i++) {
                var char = Math.floor(Math.random()
                            * str.length + 1);
                pass += str.charAt(char)
            }
            return pass;
        }

        function gfg_Run(psk_len,id) {
            document.getElementById(id).value =  generateP(psk_len);
        }

var myObj;
myObj =  [ "GPIO_5", "GPIO_6", "GPIO_13", "GPIO_16", "GPIO_19", "GPIO_20", "GPIO_21", "GPIO_22", "GPIO_23", "GPIO_26"]

document.addEventListener("DOMContentLoaded", () => {
    var i, x = "", y ;
    for (i in myObj) {
        x =  myObj[i];
        var y = $("#" + x + "_TYPE").children("option:selected").val();
            if (y != "DoorSensor") {
                $("#" + x + "_TYPE_DoorSensor").hide();
            }
            else {
                $("#" + x + "_TYPE_DoorSensor").show();
            }
    };
});

$('.gpioinputs').change(function(){
            var selectedGPIOtype = $(this).children("option:selected").val();
            var z = $(this).attr('id') + "_" + 'DoorSensor'
            if (selectedGPIOtype == 'DoorSensor') {
                $("#" + z).show();
		$("#" + z + "_HT").val("1");
            }
            else {
                $("#" + z).hide();
            }
        });

