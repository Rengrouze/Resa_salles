$(document).ready(function(){
    $('.dropdown-toggle').on('mouseenter', function(){
        $(this).parent().addClass('show');
        $(this).attr('aria-expanded', true);
        $(this).next('.dropdown-menu').addClass('show');
    });

    $('.dropdown-toggle').on('mouseleave', function(){
        var dropdownMenu = $(this).next('.dropdown-menu');
        setTimeout(function(){
            if(!dropdownMenu.is(':hover')){
                dropdownMenu.removeClass('show');
                $(this).parent().removeClass('show');
                $(this).attr('aria-expanded', false);
            }
        }, 500);
    });

    $('.dropdown-menu').on('mouseenter', function(){
        $(this).addClass('show');
        $(this).prev('.dropdown-toggle').attr('aria-expanded', true);
    });

    $('.dropdown-menu').on('mouseleave', function(){
        $(this).removeClass('show');
        $(this).prev('.dropdown-toggle').attr('aria-expanded', false);
    });
});

$(document).ready(function() {
  $('#myTab a').on('click', function(e) {
    e.preventDefault();
    $(this).tab('show');
  });
});

$(function() {
  $("#salle1-tab").click(function() {
    $("#salle-content").html("<h5>Prochaines dates disponibles :</h5><ul><li>23 avril 2023</li><li>25 avril 2023</li><li>27 avril 2023</li></ul>");
  });
  $("#salle2-tab").click(function() {
    $("#salle-content").html("<h5>Prochaines dates disponibles :</h5><ul><li>24 avril 2023</li><li>26 avril 2023</li><li>28 avril 2023</li></ul>");
  });
  $("#salle3-tab").click(function() {
    $("#salle-content").html("<h5>Prochaines dates disponibles :</h5><ul><li>23 avril 2023</li><li>25 avril 2023</li><li>27 avril 2023</li></ul>");
  });
});