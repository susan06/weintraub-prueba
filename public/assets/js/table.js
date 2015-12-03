$(document).ready(function(){
    if ($('#table-2').length) {
                var oTable = $('#table-2').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:",
                        "sLengthMenu" : "Mostrar _MENU_ Filas",
                        "sInfo":"Mostrando _START_ - _END_ de _TOTAL_ totales",
                        "sSearch" : "Buscar en todas las columnas ",
                        "oPaginate" : {
                            "sPrevious" : "Anterior",
                            "sNext" : "Siguiente"
                         }
                    },

                    "aaSorting" : [[1, 'asc']],
                    "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
                    ],

                    "iDisplayLength" : 20,
                });

                $("thead input").keyup(function () {
                    /* Filter on the column (the index) of this element */
                    oTable.fnFilter(this.value, $("thead input").index(this));
                });


                $("thead input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("thead input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("thead input").blur(function (i) {
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("thead input").index(this)];
                    }
                });
            }
});
