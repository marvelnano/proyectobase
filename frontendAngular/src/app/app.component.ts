import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { GlobalComponent } from 'src/app/global-component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
  //templateUrl: './Producto/listar/listar.component.html',
  //styleUrls: ['./Producto/listar/listar.component.css']
})
export class AppComponent {
  titulo = GlobalComponent.appTitulo;

  constructor(private route:Router){}

  ngOnInit(): void {
    this.Listar();
  }

  Listar(){
    this.route.navigate(['listar']);
  }

}
