import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Producto } from 'src/app/Modelo/Producto';
import { ServiceService } from '../../Service/service.service';
import { GlobalComponent } from 'src/app/global-component';

@Component({
  selector: 'app-detalle',
  templateUrl: './detalle.component.html',
  styleUrls: ['./detalle.component.css']
})
export class DetalleComponent implements OnInit {

  urlBackend = GlobalComponent.appUrlBackend;
  producto :Producto = new Producto();

  constructor(private router:Router, private service:ServiceService){ }

  ngOnInit(): void {
    this.Editar();
  }

  Inicio(): void{
    this.router.navigate(['plantilla']);
  }

  Editar(){
    let id = localStorage.getItem("id") || '';
    this.service.getProductoId(id)
    .subscribe(data => {
      //console.log(data)//JSON.stringify(data)
      this.producto = data;
    });
  }

}
