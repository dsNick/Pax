(function( $ ){
	
	$.fn.pax = function( options ){
	   init( options );
	   
	   this.action = function( sName, fn){
	       if(typeof fn == "function"){
		   $.fn.pax.actions[sName] = fn;
	       }
	   };
	   
	   return this;
	};
	
	var defaults = {
		init: false,
		responseId : "pax"
	}
	
	$.fn.pax.settings = {}

	$.fn.pax.actions = {
		bind 		: function(oJob){	jQuery.globalEval( "$('" + oJob.d + "').bind('" + oJob.e + "', function(){" + oJob.f + ";})" );},
		unbind		: function(oJob){	$(oJob.d).unbind(oJob.e);},
		html 		: function(oJob){	$(oJob.d).html(oJob.c);},
		append 		: function(oJob){	$(oJob.d).append(oJob.c);	},
		prepend		: function(oJob){	$(oJob.d).prepend(oJob.c);	},
		before		: function(oJob){	$(oJob.d).before(oJob.c);	},
		after		: function(oJob){	$(oJob.d).after(oJob.c);	},
		attr 		: function(oJob){	$(oJob.d).attr(oJob.a,oJob.c);	},
		console		: function(oJob){	if(typeof console =="object")console.log(oJob[0]);	},
		alert		: function(oJob){	alert(oJob[0]);	},
		script		: function(oJob){	jQuery.globalEval(oJob.c);	},
		css		: function(oJob){	$(oJob.d).css(oJob.p, oJob.v);	},
		addClass	: function(oJob){	$(oJob.d).addClass(oJob.c);	},
		removeClass	: function(oJob){	$(oJob.d).removeClass((typeof oJob.c === "string")?oJob.c:undefined);	},
		remove		: function(oJob){	$(oJob.d).remove();	},
		_debug		: function(oJob){	console.log(oJob);	}
	};
	
	function init( options ){
	    if(typeof $.fn.pax.settings.init == 'undefined'){
		$.fn.pax.settings = $.extend(defaults, options);
	    }
	    if(!$.fn.pax.settings.init){
        	    $(document).ajaxSuccess(function ( e, xhr, settings ){
        		if(xhr.responseText){
        		    try{
        			var json = $.parseJSON(xhr.responseText);
        			if( typeof json === 'object'){
        			    $.each(json, function(responseId, oJobs){
        				if( responseId == $.fn.pax.settings.responseId && typeof oJobs === 'object' && oJobs.length > 0){
        				    $.each(oJobs, function(index, oJob){
        					if ( typeof oJob === 'object') {
        					    process(oJob);
        					}					
        				    });	
        				}
        			    });
        			}
        		    } catch(e) {
        			return false;
        		    }
        		}
        	    });
        	    $.fn.pax.settings.init = true;
	    }
	};
	
	function process(oJob){
	    if(typeof $.fn.pax.actions[oJob._do] == 'function'){
		$.fn.pax.actions[oJob._do](oJob);
	    }
	};
	
})( jQuery );