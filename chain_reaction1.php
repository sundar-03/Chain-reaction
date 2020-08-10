<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#background
		{
			position: relative;
		}
		body
		{
			background-image: linear-gradient(to right,#000046,#1cb5e0);
		}
		#menu
		{
			position: absolute;
			width: 400px;
			height: 600px;
			text-align: center;
			bottom: 45px;
			border-radius: 5px;
		}
		.play
		{
			position: relative;
			width: 150px;
			height: 50px;
			border-radius: 50%;
			text-align: center;
			background-color: white;
			text:black;
			left: 125px;
			vertical-align: middle;
			line-height: 50px;
			cursor: pointer;
		}
		#help
		{
			position: relative;
			width: 450px;
			height: 500px;
			text-align: center;
			bottom: 600px;
			border: 2px solid white;
			display:none;
		}
		a
		{
			color: black;
			text-decoration: none;
		}
		a:visited{color: black;}
		a:hover{color: black;}
		a:active{color: black;}
	</style>
</head>
<body>
	<div id="background">
		<canvas id="canvas">
	</canvas>
	<div id="help">
		<br>
		<h3>
			HELP
			<br>
			<br>
			Chain reaction is a two player game where user can enter no of rows and columns.
			<br>
			For each cell in board, there will be a critical mass. Critical mass for corners is 2, critical mass for edges is 3 and critical mass for other cells will be 4.
			<br>
			All cell will be initially empty. The red colour for first player and green for second player. The red player can place a orb on empty cell or which already contains one or more red orbs. Similarly for green.
			<br>
			When a cell is loaded up with no of orbs greater than or equal to critical mass, it explodes. It will result in overloading of adjacent cells and it will continue until all become stable. 
			<br>
			When a red cell explodes it will change green cells (if present as neighbourhood) to red cells.
			<br>
			The winner is the one who eliminates every other player's orbs. ENJOY THE GAME.
		</h3>
	</div>
<div id="menu">
	<h1>
		Chain Reaction
	</h1>
	<br>
	<br>
	<div class="play">
		<a href="chain_reaction2.php">PLAY</a>
	</div>
	<br>
	<div class="play">
		HELP
	</div>
	<br>
	<div class="play">
		EXIT
	</div>
</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var canvas=document.getElementById('canvas');
	var i,j,x,y,dx,dy,radius;
	var circlearray = [];
	var colorarray = ['#ffaa33','#99ffaa','#00ff00','#4411aa','#ff1100','#add8e6','#454545'];
	canvas.width=window.innerWidth;
	canvas.height=window.innerHeight;
	document.getElementById("menu").style.left=((window.innerWidth/2) -200) +"px";
	var c=canvas.getContext('2d');
	var option=document.getElementsByClassName("play");
	option[1].onclick = function () {
		// body...
		document.getElementById("help").style.display="block";
		document.getElementById("menu").style.bottom=550+"px";
	};
	function Circle(x,y,dx,dy,radius)
	{
		this.x=x;
		this.y=y;
		this.radius=radius;
		this.dx=dx;
		this.dy=dy;
		this.color=colorarray[Math.floor(Math.random()*6)];
		this.draw = function() {
			c.beginPath();
        c.arc(this.x,this.y,this.radius,0,Math.PI*2,false);
        c.fillStyle = this.color;
        c.fill();
		}
		this.update = function()
		{
			 if(this.x+this.radius>innerWidth || this.x-this.radius<0)
        {
        	this.dx = (-1)*this.dx;
        }
        if(this.y+this.radius>innerHeight || this.y-this.radius<0)
        {
        	this.dy = (-1)*this.dy;
        }
        this.x+=this.dx;
        this.y+=this.dy;
        this.draw();

		}
	}
	for (i = 0; i < 25; i++) {
	x=Math.random()*innerWidth;
	y=Math.random()*innerHeight;
	dx=(Math.random() - 0.5)*4+6;
	dy=(Math.random() - 0.5)*4+6;
	radius=Math.random()*15+15;
	if(x<30)
	{
          x+=radius;		
	}
	if(x+30>innerWidth)
	{
		x=x-radius;
	}
	if(y<30)
	{
          y+=radius;		
	}
	if(y+30>innerHeight)
	{
		y=y-radius;
	}
	circlearray.push(new Circle(x,y,dx,dy,radius));
	}
	function animate() {
		requestAnimationFrame(animate);
        c.clearRect(0,0,innerWidth,innerHeight);
        for(j=0;j<25;j++)
        {
        	circlearray[j].update();
        }
	}
	animate();
</script>
