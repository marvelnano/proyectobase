import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ServiceService } from '../../Service/service.service';
import { Producto } from 'src/app/Modelo/Producto';
import { GlobalComponent } from 'src/app/global-component';

@Component({
  selector: 'app-listar',
  templateUrl: './listar.component.html',
  styleUrls: ['./listar.component.css']
})
export class ListarComponent implements OnInit {

  titulo = GlobalComponent.appTitulo;
  subtitulo = GlobalComponent.appSubTitulo;
  urlBackend = GlobalComponent.appUrlBackend;
  //public productos: Array<any> = []

  productos!: Producto[];
  constructor(private router:Router, private service:ServiceService){ }
  /*constructor(
    private router:Router,
    private serviveService:ServiceService
    ){
    this.serviveService.getProductos().subscribe((resp: any) => {
      //console.log(resp)
      this.productos = resp
    });
  }*/

  ngOnInit(): void {
    this.service.getProductos()
    .subscribe(data => {
      //console.log(data)
      this.productos = data
    });
  }

  Detalle(producto:Producto): void{
    //console.log('idprod: '+this.productos);
    localStorage.setItem("id",producto.idproducto.toString());
    this.router.navigate(["detalle"]);
  }

}
