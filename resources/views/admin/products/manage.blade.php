@extends('layouts.main')





@section('content')

	@if ($errors->count()!=0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>

            @endforeach

        </ul>
    @endif

<div class="col-md-10 col-md-offset-1" style="font-family: Nassim">
        <div class="panel panel-primary">
            <div class="alert alert-blue" style="text-align: center;font-size: 23px;"> product management</div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/product/submit', 'files' => true, 'method'=>'post', 'class'=>"form-horizontal", 'role'=>"form",'id'=>'topFrm' , 'onsubmit' => "post_confirm();return false")) !!}




                <div class="form-group row">
                    {!! Form::label('Product name:','',['class'=>"col-md-2 control-label"]) !!}
                    <div class="col-md-9">
                        {!! Form::text('ProductName', '', ['class'=>"form-control", 'id'=>'ProductName', 'required']) !!}
                    </div>
                </div>

                


                <div class="form-group row">
                    {!! Form::label('Quantity in stock:','',['class'=>"col-md-2 control-label"]) !!}
                    <div class="col-md-9">
                        {!! Form::text('Quantity', '', ['class'=>"form-control", 'id'=>'Quantity', 'required']) !!}
                    </div>
                </div>

                


                


                <div class="form-group row">
                    {!! Form::label('Price per item:','',['class'=>"col-md-2 control-label"]) !!}
                    <div class="col-md-9">
                        {!! Form::text('Price', '', ['class'=>"form-control", 'id'=>'Price', 'required']) !!}
                    </div>
                </div>

                


                

                
                <div class="form-group row"></div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-3">

                    {!! Form::submit('save',  ['class'=>'btn btn-primary col-md-3']) !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>




    @if($data)
    <table style="width:100%" id="table1">
	  	<tr>
		    <th>Product name</th>
		    <th>Quantity in stock</th> 
		    <th>Price per item</th>
		    <th>Datetime submitted</th>
		    <th>Total value</th>
	  	</tr>
	  @foreach ($data as $item)
		<tr>
		    <th>{{$item['ProductName']}}</th>
		    <th>{{$item['Quantity']}}</th> 
		    <th>{{$item['Price']}}</th>
		    <th>{{$item['Datetime']}}</th>
		    <th>{{$item['Total']}}</th>
	    </tr>
	  @endforeach
	  
	</table>
	@endif



	<script type="text/javascript">
		
		function post_confirm() {
			

			var FData="_token="+document.getElementsByName("_token")[0].value+"&ProductName="+document.getElementById("ProductName").value+"&Quantity="+document.getElementById("Quantity").value+"&Price="+document.getElementById("Price").value;
		  	// alert(FData);
			var xmlhttp1;
			if (window.XMLHttpRequest) {
				xmlhttp1 = new XMLHttpRequest();
			}else {
		   	// code for older browsers
			   	xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP");
		    }
		    xmlhttp1.onreadystatechange = function() {
			   	if (this.readyState == 4 && this.status == 200) {
			  		var table1 = document.getElementById('table1').innerHTML;
					table1 = table1 + this.responseText;
					document.getElementById('table1').innerHTML = table1;
			   	}
		    };
			xmlhttp1.open("POST", '{{asset("/admin/product/submit")}}', true);
		  	xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    xmlhttp1.send(FData);

		    
			return false;
	}
	</script>
@endsection



