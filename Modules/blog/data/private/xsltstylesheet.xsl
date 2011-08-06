<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"
		media-type="text/html"
		omit-xml-declaration="yes"
		encoding="UTF-8"
		indent="yes" 
		extension-element-prefixes="xsl"/>       
		<xsl:preserve-space elements="code"></xsl:preserve-space> 
				
<xsl:template match="/">              
	<xsl:text disable-output-escaping="yes">&lt;</xsl:text>!DOCTYPE html<xsl:text disable-output-escaping="yes">&gt;&#xa;</xsl:text>
	<xsl:apply-templates select="blogentry"/>
</xsl:template>

<xsl:template match="blogentry">           
	<xsl:element name="html">
		<xsl:element name="head">
			<xsl:element name="title"><xsl:value-of select="title"/></xsl:element> 
			<xsl:element name="script"> 
				<xsl:attribute name="type">text/javascript</xsl:attribute>
				<xsl:attribute name="src">https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js</xsl:attribute>
			</xsl:element>   
			<xsl:element name="script"> 
				<xsl:attribute name="type">text/javascript</xsl:attribute>
				<xsl:attribute name="src">https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.js</xsl:attribute>
			</xsl:element>
			<xsl:element name="script"> 
				<xsl:attribute name="type">text/javascript</xsl:attribute>
				<xsl:attribute name="src">/writable/public/js/gallery.js</xsl:attribute>
			</xsl:element>          
			<xsl:element name="link">
				<xsl:attribute name="rel">stylesheet</xsl:attribute>
				<xsl:attribute name="type">text/css</xsl:attribute>
				<xsl:attribute name="href">/writable/public/css/gallery.css</xsl:attribute>
			</xsl:element>
		</xsl:element>  
		
		<xsl:element name="body">
			<xsl:element name="h1">
				<xsl:attribute name="style">
					font-family: Helvetica, Verdana, sans-serif; 
					margin:10px; 
					padding:0;
				</xsl:attribute>
				<xsl:value-of select="title" />  
			</xsl:element>  
			
			<xsl:element name="div">
				<xsl:attribute name="style">
					padding: 0px 20px;
					margin: 0px 20px;
					display: block;
					width:500px;
				</xsl:attribute> 
				
				<xsl:apply-templates select="para|yt|code|gallery|pic|vimeo|gist" />
			</xsl:element>    
			
			<xsl:element name="hr"/>
			
			<xsl:element name="h3">
				<xsl:text>last edit: </xsl:text><xsl:value-of select="date"/> 
			</xsl:element>
		</xsl:element>
	</xsl:element>
</xsl:template>     

<xsl:template match="para">            
	<xsl:for-each select=".">
		<xsl:element name="p">
			<xsl:attribute name="class">para</xsl:attribute>
			<xsl:if test="count(subtitle)"> 
				<xsl:element name="h3">
					<xsl:attribute name="style">
          	font-family: Helvetica, Verdana, sans-serif; 
						margin: 30px auto 5px 0;
					</xsl:attribute>      
	  			<xsl:value-of select="subtitle"/>   
				</xsl:element>
			</xsl:if>
			<xsl:value-of select="content"/>
		</xsl:element>      
	</xsl:for-each>
</xsl:template>    

<xsl:template match="code">        
	<xsl:element name="div">
		<xsl:attribute name="class">code</xsl:attribute>
		<xsl:attribute name="style">
			border:1px solid #DDD;
			margin:10px 0;    
			padding:10px;
		</xsl:attribute>              
		
		<xsl:element name="h3">
			<xsl:attribute name="style">
				padding: 0; 
				margin: 0;
			</xsl:attribute>
			<xsl:value-of select="title"/>
		</xsl:element>
		                  
		<xsl:element name="pre">
			<xsl:value-of select="listing"/>
		</xsl:element>
	</xsl:element>
</xsl:template>          

<xsl:template match="gist"> 
	<xsl:if test="count(title)"> 
		<xsl:element name="h3">
			<xsl:attribute name="style">
      	font-family: Helvetica, Verdana, sans-serif; 
				margin: 30px auto 5px 0;
			</xsl:attribute>      
			<xsl:value-of select="title"/>   
		</xsl:element>
	</xsl:if>
	
	<xsl:element name="script">
  	<xsl:attribute name="src">
			<xsl:text>https://gist.github.com/</xsl:text>
			<xsl:value-of select="id"/>
			<xsl:text>.js</xsl:text>
		</xsl:attribute>
	</xsl:element>
</xsl:template>

<xsl:template match="yt">  
	<xsl:element name="div">
		<xsl:attribute name="class">yt</xsl:attribute>
		<xsl:attribute name="style">  
			text-align: center;
			margin: 30px 0;  
		</xsl:attribute>  

		<xsl:if test="count(title)">  
			<xsl:element name="h3">  
				<xsl:attribute name="style">
			 		font-family:Helvetica, Verdana, sans-serif; 
					margin: 5px auto;
				</xsl:attribute>   
  			<xsl:value-of select="title"/>      
			</xsl:element>
		</xsl:if>          
		
		<xsl:element name="iframe">
			<xsl:attribute name="style">
				border: 0;      
				height: 300px;
				width: 400px;      
			</xsl:attribute>
			<xsl:attribute name="class">youtube-player</xsl:attribute>
			<xsl:attribute name="type">text/html</xsl:attribute>
			<xsl:attribute name="src">http://www.youtube.com/embed/<xsl:value-of select='id'/>?
				<xsl:if test="count(start)">&amp;start=<xsl:value-of select="start"/></xsl:if>
			</xsl:attribute> 
		</xsl:element>				
	</xsl:element>
</xsl:template>

<xsl:template match="gallery">                                
	<xsl:element name="div">
		<xsl:attribute name="id">slideshow</xsl:attribute>      
		
		<xsl:element name="div">        
			<xsl:attribute name="id">slidesContainer</xsl:attribute>
	
			<xsl:for-each select="pic">
				<xsl:element name="div"> 
					<xsl:attribute name="class">slide</xsl:attribute> 
					       
					<xsl:if test="count(title)">  
						<xsl:element name="h3">  
							<xsl:attribute name="style">
								margin-left: 50px;
							</xsl:attribute>   
							<xsl:value-of select="title"/>      
						</xsl:element>
					</xsl:if>                    
					
						<xsl:element name="img">
						<xsl:attribute name="src"><xsl:value-of select="file"/></xsl:attribute>
						<xsl:attribute name="style">   
							margin: 0 20px;
							width: 480px;
							height: 250px;
						</xsl:attribute>
					</xsl:element>    

				</xsl:element>
			</xsl:for-each>
		</xsl:element> 
	</xsl:element>
</xsl:template>

<xsl:template match="pic">
	<xsl:element name="div">
		<xsl:attribute name="style">
			border: 1px solid #DDD;
			text-align: center;    
			margin: 30px 0;  
		</xsl:attribute>     
		
		<xsl:element name="h3">
			<xsl:value-of select="title"/>
		</xsl:element>                
	
		<xsl:element name="img">
			<xsl:attribute name="width">100%</xsl:attribute>
			<xsl:attribute name="src"><xsl:value-of select="file"/></xsl:attribute>
		</xsl:element> 
	</xsl:element> 
</xsl:template>      

<xsl:template match="vimeo"> 
	<xsl:element name="div">   
		<xsl:attribute name="style">
			text-align: center;    
			margin: 30px 0;        
			width:100%;
			height:100%;
		</xsl:attribute>      
		
		<xsl:if test="count(title)">  
			<xsl:element name="h3">  
				<xsl:attribute name="style">
			 		font-family:Helvetica, Verdana, sans-serif; 
					margin: 5px auto;
				</xsl:attribute>   
  			<xsl:value-of select="title"/>      
			</xsl:element>
		</xsl:if>
		  
		<xsl:element name="iframe">    
			<xsl:attribute name="style">
				border: 0;
				width: 400px;
				height: 300px;            
			</xsl:attribute>          
			
			<xsl:attribute name="src">
				http://player.vimeo.com/video/<xsl:value-of select="id"/>?byline=0&amp;portrait=0&amp;color=008C82
			</xsl:attribute>
		</xsl:element>         
	</xsl:element>		
</xsl:template>
	      
</xsl:stylesheet>              