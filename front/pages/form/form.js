
window.addEventListener("DOMContentLoaded", () => {

        document.querySelector("#datePayment").valueAsDate = new Date();

        getMethods();
        getCategories();

        document.getElementById("addButton").addEventListener ("click", () => {
                const idMethod = document.getElementById("methods-select");
                const idCategory = document.getElementById("catagories-select");
                const amount = document.getElementById("amount");
                const datePayment = document.getElementById("datePayment");
                
                addPayment(JSON.parse(sessionStorage.getItem("user")).iduser, idMethod.value, idCategory.value, amount.value, datePayment.value);
        });

        function getMethods() {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        let methods = JSON.parse(xhr.responseText);
                        let options = '<label for="methods">Moyen de paiement</label><select name="methods" id="methods-select">';
                        methods.forEach(element => {
                                options += '<option value="' + element.idpaying_method + '">' + element.label + '</option>'
                        });
                        options += '</select>';
                        document.getElementById("method").innerHTML = options;
                }
                };
                xhr.open("GET", "https://l3m.alwaysdata.net/payment/method/methods", true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(null);
        }

        function getCategories() {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        let methods = JSON.parse(xhr.responseText);
                        let options = '<label for="categories">Catégorie</label><select name="categories" id="catagories-select">';
                        methods.forEach(element => {
                                options += '<option value="' + element.idpayment_category + '">' + element.label + '</option>'
                        });
                        options += '</select>';
                        document.getElementById("category").innerHTML = options;
                }
                };
                xhr.open("GET", "https://l3m.alwaysdata.net/payment/category/categories", true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(null);
        }

        function addPayment(idUser, idMethod, idCategory, amount, datePayment) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        if (JSON.parse(xhr.responseText) != null) {
                                window.location.href = "../dashboard/index.html";
                        } else {
                                document.getElementById("error-message").innerHTML = "Une erreur est survenue.";
                        }
                }
                };
                xhr.open("GET", "/spphp61/back/index.php?action=addPayment&idUser=" + idUser + "&method=" + idMethod + "&category=" + idCategory + "&amount=" + amount + "&datePayment=" + datePayment, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(null);
        }

});