$(function() {

	$('#graph').css("display", "none");
	$('h1').fadeIn(1500);
  	$('button').fadeIn(1500);

  	$('button').click(function() {
  		$('#cta').fadeOut();
  		$('#graph').delay(750).fadeIn();
  	});

  	//GRAPH
  	var w = 400;
    var h = 400;
    var r = h / 2;
    var color = d3.scale.category10();

    var data = [{"label":"Super Mario Bros. (1985)", "value":55750000}, 
        {"label":"Tetris (2006)", "value":495000000},
        {"label":"Wii Sports (2006)", "value":82780000},
        {"label":"Minecraft (2009)", "value":106860000},
        {"label":"GTA V (2013)", "value":65000000}];


    var vis = d3.select('#graph').append("svg:svg").data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
    var pie = d3.layout.pie().value(function(d){return d.value;});
    var arc = d3.svg.arc().outerRadius(r);

    var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice");
    arcs.append("svg:path")
        .attr("fill", function(d, i){
            return color(i);
        })
        .attr("d", function (d) {
            return arc(d);
        });

    arcs.append("svg:text").attr("transform", function(d){
        d.innerRadius = 0;
        d.outerRadius = r;
        return "translate(" + arc.centroid(d) + ")";}).attr("text-anchor", "middle").text( function(d, i) {
        return data[i].label;}
        );

});





