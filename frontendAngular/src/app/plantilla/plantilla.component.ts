import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { GlobalComponent } from 'src/app/global-component';

@Component({
  selector: 'plantilla',
  templateUrl: './plantilla.component.html',
  styleUrls: ['./plantilla.component.css']
})
export class PlantillaComponent implements OnInit {

  titulo = GlobalComponent.appTitulo;
  subtitulo = GlobalComponent.appSubTitulo;

  constructor(private router:Router) { }

  ngOnInit(): void {
    this.Listarproductos();
  }

  Listarproductos(){
    this.router.navigate(['listar']);
  }
}
