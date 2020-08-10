<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<style type="text/css">
			#table
			{
				top:50px;
			}
			#new_game
			{
				cursor: pointer;
				width: 150;
				height: 100;
				border-radius: 50%;
				position: relative;
			}
			a
			{
				text-decoration: none;
			}
		</style>
</head>
<body>
	<div id="new_game">
		<a href="chain_reaction1.php">NEW GAME</a>
	</div>
</body>
</html>
<script type="text/javascript">
var i,j,rows,d,p,q,tbl,atts,x,y,player,dot,t,att,motioninterval,motioninterval1,motioninterval2,cn,cn1,cn2,currentpos,currentpos1,currentpos2,i1,i2,j1,j2,i3,j3;
var unstable=[];
player=0;
var new_game=document.getElementById("new_game");
new_game.style.left=window.innerWidth/2 - 75+"px";
var rw = '<?php echo $_POST['rows'];?>';
var cl = '<?php echo $_POST['columns'];?>';
var playerA = '<?php echo $_POST['playera'];?>';
var playerB = '<?php echo $_POST['playerb'];?>';
var grid = new Array(rw);
tbl=document.createElement("table");
atts=document.createAttribute("style");
atts.value = "border: 3px solid green; text-align:center; position:relative; margin: 0px auto; margin-top:20px;";
tbl.setAttribute("id","table");
tbl.setAttributeNode(atts);
grid_object_creator();
	function Grid_object(neighbour,count,color,x,y)
	{
		this.neighbour=neighbour;
		this.count=count;
		this.color=color;
		this.x=x;
		this.y=y;
	}
	function top_dot(i,j) {
		// body...
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; left:28px; bottom:28px;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
	}
	function left_dot(i,j) {
		// body...
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; float:left;border-style:dotted; position:relative;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
	}
	function right_dot(i,j) {
		// body...
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; float:right;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
	}
	function bottom_dot(i,j) {
		// body...
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; left:28px; top:28px;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
	}
	function corner_condition(i,j) {
		// body...
		if(i==0 && j==0 || i==0 && j==(cl -1) || j==0 && i==(rw-1) || i==(rw-1) && j==(cl-1))
		return 1;
		else
		return 0;
	}
	function edge_condition(i,j) {
		// body...
		if (i==0 || i==(rw-1) || j==0 || j==(cl-1))
		return 1;
		else 
		return 0;
	}
	function third_ball(i,j,k,l) {
		// body...
		child_remover(i,j,0,0);
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; top:8px; left:28px;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
        dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; float:right; border-style:dotted; position:relative; right:22px; ";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
        dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; left:22px; ";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
        if(l==1)
        grid[i][j].count+=1;
          	if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
	}
	function child_remover(i,j,k,l) {
		// body...
		 t=document.getElementById("r"+i+"c"+j).lastElementChild;
        		while(t)
        		{
        			document.getElementById("r"+i+"c"+j).removeChild(t);
        			t=document.getElementById("r"+i+"c"+j).lastElementChild;
        		}
        if(k==1)
        grid[i][j].color="no_color";
    	if(l==1)
    	grid[i][j].count=0;
	}
	function second_ball(i,j,k,l) {
		// body...
		child_remover(i,j,0,0);
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; top:0px; left:28px;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
        dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; left:28px; bottom:12px;";
	    dot.setAttributeNode(att);
        document.getElementById("r"+i+"c"+j).appendChild(dot);
        dot.style.backgroundColor=grid[i][j].color;
        if(l==1)
        grid[i][j].count+=1;
          	if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
	}
	function corner_blast(i,j,k) {
		// body...
		child_remover(i,j,0,0);
		if(i==0)
		{
			if(j==0)
			right_dot(i,j);
			else
			left_dot(i,j);
			bottom_dot(i,j);
		}
		else
		{
			if(j==0)
			right_dot(i,j);
			else
			left_dot(i,j);
			top_dot(i,j);
		}
		if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
          currentpos=0;
          grid[i][j].count+=1;
          motioninterval=setInterval(corner_animation,1,i,j,7);
	}
	function edge_blast(i,j,k) {
		// body...
		child_remover(i,j,0,0);
		if(i==0)
		{
			left_dot(i,j);
			right_dot(i,j);
			bottom_dot(i,j);
		}
		if(i==(rw-1))
		{
			left_dot(i,j);
			right_dot(i,j);
			top_dot(i,j);
		}
		if(j==0)
		{
			top_dot(i,j);
			right_dot(i,j);
			bottom_dot(i,j);
		}
		if(j==(cl-1))
		{
			top_dot(i,j);
			left_dot(i,j);
			bottom_dot(i,j);
		}
		if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
		currentpos1=0;
		grid[i][j].count+=1;
		motioninterval1 = setInterval(edge_animation,1,i,j,7);
	}
	function middle_blast(i,j,k) {
		// body...
		child_remover(i,j,0,0);
		top_dot(i,j);
		left_dot(i,j);
		right_dot(i,j);
		bottom_dot(i,j);
		if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
		currentpos2=0;
		grid[i][j].count+=1;
		motioninterval2 = setInterval(middle_animation,1,i,j,1);
	}
	function middle_animation(i,j,speed) {
		// body...
		cn2=document.getElementById("r"+i+"c"+j).childNodes;
		currentpos2+=speed;
		if(currentpos2>=35)
		{
			clearInterval(motioninterval2);
			execute();
		}
		cn2[0].style.bottom=28+currentpos2+"px";
		cn2[1].style.right=currentpos2+"px";
		cn2[2].style.left=currentpos2+"px";
		cn2[3].style.top=28+currentpos2+"px";
	}
function corner_animation(i,j,speed) {
		// body...
		cn=document.getElementById("r"+i+"c"+j).childNodes;
		currentpos+=speed;
		if(currentpos>=35)
		{
			clearInterval(motioninterval);
			execute();
		}
		if(i==0)
		{
			cn[1].style.top=28+currentpos+"px";
			if(j==0)
			cn[0].style.left=currentpos+"px";
			else
			cn[0].style.right=currentpos+"px";
		}
		else
		{
			cn[1].style.bottom=28+currentpos+"px";
			if(j==0)
			cn[0].style.left=currentpos+"px";
			else
			cn[0].style.right=currentpos+"px";
		}
	}
function edge_animation(i,j,speed) {
	// body...
	cn1=document.getElementById("r"+i+"c"+j).childNodes;
	currentpos1+=speed;
	if(currentpos1>=35)
	{
		clearInterval(motioninterval1);
		execute();
	}
	if(i==0 || i==(rw-1))
	{
		cn1[0].style.right=currentpos1+"px";
		cn1[1].style.left=currentpos1+"px";
		if(i==0)
		cn1[2].style.top=28+currentpos1+"px";
		else
		cn1[2].style.bottom=28+currentpos1+"px";
	}
	else
	{
		cn1[0].style.bottom=28+currentpos1+"px";
		cn1[2].style.top=28+currentpos1+"px";
		if(j==0)
		cn1[1].style.left=currentpos1+"px";
		else
		cn1[1].style.right=currentpos1+"px";
	}
}
	function first_ball(i,j,k,l) {
		// body...
		child_remover(i,j,0,0);
		dot=document.createElement("div");
	    att=document.createAttribute("style");
	    att.value = "width:24px; height:24px; border-radius:50%; border:2px solid blue; border-style:dotted; position:relative; top:0px; left:28px;";
	      dot.setAttributeNode(att);
	      dot.style.backgroundColor=grid[i][j].color;
          	document.getElementById("r"+i+"c"+j).appendChild(dot);
          	if(l==1)
          	grid[i][j].count+=1;
          	if(k==1){
          	 if(player%2==0)
          	 player=1;
          	 else
          	 player=0;
          }
	}
	function grid_object_creator() {
		// body...
		for (i = 0; i <rw ; i++) 
	{
		grid[i] = new Array(cl);
	}
	for (i = 0;i<rw; i++)
	 {
		for (j = 0; j < cl; j++)
		 {
			if(corner_condition(i,j)==1)
				grid[i][j]=new Grid_object(2,0,"no_color",i,j);
			else if (edge_condition(i,j)==1)
				grid[i][j]=new Grid_object(3,0,"no_color",i,j);
			else 
				grid[i][j]=new Grid_object(4,0,"no_color",i,j);
		}
	}
	}
	
    for(i=0;i<rw;i++)
    {
    	rows = tbl.insertRow(i);
    	for(j=0;j<cl;j++)
    	{
    		d = rows.insertCell(j);
          d.height = "90px";
          d.width = "90px";
          d.id = "r"+i+"c"+j;
          d.style.backgroundColor= "black";
          d.onclick=(function(i,j)
          {
          	return function()
          	{
          		if(player==0)
          		{
          			if(grid[i][j].color=="no_color" || grid[i][j].color=="red")
          			{
          				grid[i][j].color="red";
          				if(corner_condition(i,j)==1)
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else
          					corner_blast(i,j,1);
          				}
          				else if(edge_condition(i,j)==1)
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else if(grid[i][j].count==1)
          					second_ball(i,j,1,1);
          					else
          					edge_blast(i,j,1);
          				}
          				else
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else if(grid[i][j].count==1)
          					second_ball(i,j,1,1);
          					else if(grid[i][j].count==2)
          					third_ball(i,j,1,1);
          					else
          					middle_blast(i,j,1);
          				}
          			}
          			else
          			alert("OOPS!!You cannot place your ball on opponent's place");
          		}
          		else
          		{
          			if(grid[i][j].color=="no_color" || grid[i][j].color=="green")
          			{
          				grid[i][j].color="green";
          				if(corner_condition(i,j)==1)
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else          						
          					corner_blast(i,j,1);
          				}
          				else if(edge_condition(i,j)==1)
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else if(grid[i][j].count==1)
          					second_ball(i,j,1,1);
          					else
          					edge_blast(i,j,1);
          				}
          				else
          				{
          					if(grid[i][j].count==0)
          					first_ball(i,j,1,1);
          					else if(grid[i][j].count==1)
          					second_ball(i,j,1,1);
          					else if(grid[i][j].count==2)
          					third_ball(i,j,1,1);
          					else
          					middle_blast(i,j,1);
          				}
          			}
          			else
          			alert("OOPS!!You cannot place your ball on opponent's place");
          		}
          	}
          }
          	)(i,j);
    	}
    }
    function execute() {
    	// body...
    	i3=1;
    	p=0;
    	q=0;
    	while(i3)
    	{
    		for(i=0;i<rw;i++)
    		{
    			for(j=0;j<cl;j++)
    			{
    				if(grid[i][j].count>=grid[i][j].neighbour)
    				{
    					child_remover(i,j,0,0);
    					grid[i][j].count = grid[i][j].count-grid[i][j].neighbour;
    					unstable.push(new Grid_object(grid[i][j].neighbour,grid[i][j].count,grid[i][j].color,i,j));
    				}
    			}
    		}
    		if(unstable.length==0)
    		{
    			i3=0;
    		}
    		else
    		{
    			j=unstable.length;
    			for(i=0;i<j;i++)
    			{
    				if(unstable[i].x-1>=0)
    				{
    					grid[unstable[i].x-1][unstable[i].y].count+=1;
    					grid[unstable[i].x-1][unstable[i].y].color=unstable[i].color;

    				}
    				if(unstable[i].x+1<rw){
    					grid[unstable[i].x+1][unstable[i].y].count+=1;
    					grid[unstable[i].x+1][unstable[i].y].color=unstable[i].color;
    				}
    				if(unstable[i].y-1>=0)
    				{
    					grid[unstable[i].x][unstable[i].y-1].count+=1;
    					grid[unstable[i].x][unstable[i].y-1].color=unstable[i].color;
    				}
    				if(unstable[i].y+1<cl){
    					grid[unstable[i].x][unstable[i].y+1].count+=1;
    					grid[unstable[i].x][unstable[i].y+1].color=unstable[i].color;
    				}
    			}
    			unstable=[];
    		}
    	}
    	for(i=0;i<rw;i++)
    	{
    		for(j=0;j<cl;j++)
    		{
    			if(grid[i][j].count==0)
    			grid[i][j].color="no_color";
    			else if(grid[i][j].count==1)
    			first_ball(i,j,0,0);
    			else if(grid[i][j].count==2)
    			second_ball(i,j,0,0);
    			else
    			third_ball(i,j,0,0);

    			if(grid[i][j].color=="red")
    				p+=1;
    			if(grid[i][j].color=="green")
    				q+=1;
    		}
    	}
    	if(p==0)
    	alert(playerB+" wins");
    	if(q==0)
    	alert(playerA+" wins");
    }
document.body.appendChild(tbl);
</script>
