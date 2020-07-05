window.addEventListener("DOMContentLoaded", () => {
    getData();

    document.getElementById("addPaymentButton").addEventListener ("click", () => {
        window.location.href = "../form/index.html";
    });

    function getData() {
        const payload = {
            action: "getPaymentList",
            id: JSON.parse(sessionStorage.getItem("user")).iduser
        };
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (JSON.parse(xhr.responseText) != null) {
                    let data = JSON.parse(xhr.responseText);
                    let list = document.getElementById("payment-list");
                    let xData = [];
                    let yData = [];
                    
                    let globalAmount = 0;
                    data.forEach(element => {
                        let line = document.createElement("tr");
    
                        let montant = document.createElement("td");
                        let date = document.createElement("td");
                        let method = document.createElement("td");
                        let category = document.createElement("td");
                        let type = document.createElement("td");
    
                        montant.innerHTML = element.amount;
                        date.innerHTML = element.date;
                        method.innerHTML = element.paymentMethodIdpayingMethod.label;
                        category.innerHTML = element.paymentCategoryIdpaymentCategory.label;
                        type.innerHTML = element.paymentCategoryIdpaymentCategory.categoryTypeIdcategoryType.label;
    
                        line.appendChild(montant);
                        line.appendChild(date);
                        line.appendChild(method);
                        line.appendChild(category);
                        line.appendChild(type);
                        
                        list.appendChild(line);

                        if (element.type === "crédit") {
                            globalAmount += parseFloat(element.amount);
                        } else {
                            globalAmount -= parseFloat(element.amount);
                        }

                        xData.push(element.date);
                        yData.push(globalAmount);
                    });

                    let plot = document.getElementById("plot");

                    let trace1 = {
                        x: xData,
                        y: yData,
                        mode: "lines+markers",
                        name: 'linear',
                        line: {shape: 'linear'},
                        type: 'scatter'
                      };

                    let layout = {
                        title: 'Récapitulatif des opérations',
                        xaxis: {
                          title: 'date',
                          showgrid: false,
                          zeroline: false
                        },
                        yaxis: {
                          title: 'opérations (€)',
                          showline: false
                        }
                      };
                        
                    Plotly.newPlot(
                        plot,
                        [trace1],
                        layout,
                        { margin: { t: 0 } }
                    );

                    window.onresize = function () {
                        let graphContainer = document.getElementById("graph-container");
                        let update = {
                            width: graphContainer.clientWidth
                        };
                        Plotly.relayout(plot, update);
                    };
                } else {
                    console.log("http error");
                }
            }
        };
        xhr.open("GET", "https://l3m.alwaysdata.net/payment/list?id=" + JSON.parse(sessionStorage.getItem("user")).iduser, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(null);
    }
})
