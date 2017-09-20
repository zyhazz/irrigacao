$(document).ready(function(){
 
var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
         
        var alvo = $(this).data("field");
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#"+alvo).val());
         
        // If is not undefined
            
            $('#'+alvo).val(quantity + 1);
 
           
            // Increment
         
    });
 
    $('.quantity-left-minus').click(function(e){
        var alvo = $(this).data("field");
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#"+alvo).val());
         
        // If is not undefined
       
            // Increment
            if(quantity>0){
                $('#'+alvo).val(quantity - 1);
            }
    });
    

    function carregaConfig(){
        $.getJSON( "getConfig.php", function( json ) {
            //console.log( "JSON Data: " + json);
            $('#min').val(json.min);
            $('#max').val(json.max);
            $('#limite').val(json.interval);
        });
    }

    carregaConfig();

    var graph = new Chartist.Line('.chart', {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      series: [
        [12, 9, 7, 8, 5]
      ]
    }, {
        high: 100,
        low: 0,
        fullWidth: true,
        chartPadding: {
        right: 40
      }
    });

    function graphUpdate(input){
        var labels = input.map(function(a) {return a.dataHora;});
        var series = input.map(function(a) {return a.valor_umidade;});
        //console.log(labels.reverse());
        //console.log(series.reverse());

        graph.update({

            labels: labels.reverse(),
            series: [series.reverse()]
        })
    }
    
    function carregaDados(){
        console.log("carregando dados");
        $.getJSON( "getData.php", function( json ) {
            //console.log(json);
            graphUpdate(json);
            //console.log( "JSON Data: " + json);
            //$('#min').val(json.min);
            //$('#max').val(json.max);
            //$('#limite').val(json.interval);
        });
    }

    setInterval(carregaDados, 1000);

    carregaDados();

});