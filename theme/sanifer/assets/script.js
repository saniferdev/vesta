(function ($) {
  'use strict';

  // data background
  $('[data-background]').each(function () {
    $(this).css({
      'background-image': 'url(' + $(this).data('background') + ')'
    });
  });

  // collapse
  $('.collapse').on('shown.bs.collapse', function () {
    $(this).parent().find('.ti-plus').removeClass('ti-plus').addClass('ti-minus');
  }).on('hidden.bs.collapse', function () {
    $(this).parent().find('.ti-minus').removeClass('ti-minus').addClass('ti-plus');
  });

  // match height
  $('.match-height').matchHeight({
    byRow: true,
    property: 'height',
    target: null,
    remove: false
  });


  $("#search").keypress(function(event) {
    if (event.which == 13) {
      san.Recherche();
    }       
  });
  
  $(document).on( "click",".r_", function() {
    $("#loading").show();
    $.ajax({
      method: "POST",
      url: "result.php",
      async: true,
      cache: false,
      data: { id: $(this).attr("id") }
    }).done(function(res){
      $('.Articlemodal-lg').modal('hide');
      var articles_ = $(".articles_").html();
      $("#loading").hide();
      $('.articles_').hide().html(res + articles_).fadeIn('slow');
      calc.Somme();
      var site_ = $("#site").val();
      $("td."+site_).css({"background-color": "#3598dc", "color": "#FFFFFF"});
    });
    
     return false;
  });

  var site = $("#site").val();
  $("th."+site).css({"background-color": "#f8d13b", "color": "#FFFFFF"});

  $(document).on("click", ".delete", function(){
      $(this).parents("tr").remove();
      calc.Somme();
      return false;
  });

  $(document).on("click", ".supprimer_tout", function(){
      location.reload();
      return false;
  });

  $(document).on("click", ".reactualiser", function(){
    var rowCount = $(".articles_ tr").length;
    if(rowCount > 0){
      $("#loading").show();
      var arr  = [];
      var arr2 = [];

      $(".articles_ tr").each(function(){
          arr.push($(this).find("td:first").text());
          arr2.push($(this).children().eq(5).children("span").text());
      });

      var result =  arr2.reduce(function(result, field, index) {
        result[arr[index]] = field;
        return result;
      }, {});

      $.ajax({
          method: "POST",
          url: "result.php",
          async: true,
          cache: false,
          data: { react: result }
        }).done(function(res){
          $("#loading").hide();
          $(".ligne_").remove();
          $(".articles_").html(res).fadeIn('slow');
          var sites_ = $("#site").val();
          $("td."+sites_).css({"background-color": "#3598dc", "color": "#FFFFFF"});

          calc.Somme();
        });
    }
    return false;
  });

  $(document).on("click", ".imprimer", function(e){
    var rowCount = $(".articles_ tr").length;
    if(rowCount > 0){
      $("#loading").show();
      var arr  = [];
      var arr2 = [];

      $(".articles_ tr").each(function(){
          arr.push($(this).find("td:first").text());
          arr2.push($(this).children().eq(5).children("span").text());
      });

      var result =  arr2.reduce(function(result, field, index) {
        result[arr[index]] = field;
        return result;
      }, {});

      $.ajax({
          method: "POST",
          url: "http://192.168.130.73/vesta/tcpdf/sanifer/impression.php",
          async: true,
          cache: false,
          data: { num: result },
        }).done(function(res){
          var url_ = "http://192.168.130.73/vesta/tcpdf/sanifer/uploads/";
          window.open(url_+res);
          $("#loading").hide();
        });
    }
    return false;
  });

  var calc = {};
  calc.Somme=function(e) {
    let sommePV = 0;
      $( "table.table tbody.articles_ tr").each( function(e) {
        let qte     = $( this ).children().eq(5).children("span").text();
        if(qte.replace(/ /g,'') == ""){
         qte = 1;
        }
        let p       = $( this ).children().eq(4).text();
        let pv      = p.replace(/\s+/g, "");
        let pv_     = pv.split(',');
        const total = (qte*pv_[0]).toLocaleString("fr-FR", {
                          minimumFractionDigits: 2, 
                          maximumFractionDigits: 2 
                        });
        $( this ).children().eq(5).children("input").val(qte);
        $( this ).children().eq(6).text(total);

        let s     = qte * pv_[0];
        sommePV   += s;

      });
      const SumPV = sommePV.toLocaleString("fr-FR", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2 
                    });
      $(".somme").text(SumPV + " Ar");

    return false;

  }

  $(document).on("keyup mouseup","td.qte input", function (event) {
    $(this).parent("td").children("span").text($(this).val());
    let sommePV = 0;
      $( "table.table tbody.articles_ tr").each( function(e) {
        let qte     = $( this ).children().eq(5).children("span").text();
        if(qte.replace(/ /g,'') == ""){
         qte = 1;
        }
        let p       = $( this ).children().eq(4).text();
        let pv      = p.replace(/\s+/g, "");
        let pv_     = pv.split(',');
        const total = (qte*pv_[0]).toLocaleString("fr-FR", { 
                          minimumFractionDigits: 2, 
                          maximumFractionDigits: 2 
                        });
        $( this ).children().eq(6).text(total);

        let s     = qte * pv_[0];
        sommePV   += s;

      });
      const SumPV = sommePV.toLocaleString("fr-FR", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2 
                    });
      $(".somme").text(SumPV + " Ar");
  });

  var san = {}; 
  san.Recherche=function() { 
    $('#search').each(function() {
      if ($(this).val() != "") {
        if ($.fn.DataTable.isDataTable("#datatable_")) {
          $('#datatable_').DataTable().clear().destroy();
        }
        $("#loading").show();

        $.ajax({
          method: "POST",
          url: "result.php",
          data: { recherche: $(this).val() }
        }).done(function(res){
          $("#search").val("");
          $("#loading").hide();
          if ( res.indexOf('ligne_') > -1 ) {
            var articles_ = $(".articles_").html();
            $('.articles_').hide().html(res + articles_).fadeIn('slow');
            var site_ = $("#site").val();
            $("td."+site_).css({"background-color": "#3598dc", "color": "#FFFFFF"});
            calc.Somme(); 
          }
          else{
            $(".resultat").html(res);          
            $('#datatable_').DataTable({
                "order": [ 1, "asc" ],
                "pageLength": 10,
                "language": {
                    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                    "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Afficher _MENU_ éléments",
                    "sLoadingRecords": "Chargement...",
                    "sProcessing":     "Traitement...",
                    "sSearch":         "Rechercher :",
                    "sZeroRecords":    "Aucun élément correspondant trouvé",
                    "oPaginate": {
                        "sFirst":    "Premier",
                        "sLast":     "Dernier",
                        "sNext":     "Suiv",
                        "sPrevious": "Préc"
                    },
                    "oAria": {
                        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                    },
                    "select": {
                            "rows": {
                                "_": "%d lignes sélectionnées",
                                "0": "Aucune ligne sélectionnée",
                                "1": "1 ligne sélectionnée"
                            } 
                    }
                }
            });
            $('.Articlemodal-lg').modal('show');
          }
        });
      }
      else return false;
    });
  };

})(jQuery);