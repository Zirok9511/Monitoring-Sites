//: Playground - noun: a place where people can play

import UIKit
// 2 - Escribir un programa con lenguaje Swiftr para multiplicar dos numeros cualquiera, tipo float

var uno: Float = 9.5
var dos: Float = 5.9
var resultado = uno * dos
print("EL RESULTADO ES: \(resultado)")


//3 - Escribir con codigo Swift , que arealice la operacion de suma de un numero cualquiera tipo float con tipo double y el resultado sea double
var num1: Float = 9.5
var num2: Double = 5.9
var op = Float(num2) //para poder sumarlos y almacenarlo en el float utilice optional
var total: Float
total = num1 + op
print("EL RESULTADO ES: \(total)")


//4 - Escribir un programa con lenguaje swift para realizar el calculo del area de un circulo A= pir2, considere el tipo de dato adecuado para el tipo de operacion
var radio: Double = 9.5
var area: Double
area = M_PI * pow (radio, 2)
print("El area es: \(area)")


//5 - Escribir con codigo swift, que realice la operacion resta de fdos numero cualquier, considerando que uno e stipo int y el otro es tipo string y el resultado es tipo int
var pri: Int = 8
var str = "4"
var seg =  Int(str)
var resta = pri - seg!
print("El resultado es: \(resta)")



//6 - Escribir un programa con lenguaje SWIFT para realizar el calculo del area de un tringulo rectangulo A= b.h/2, considere el tipo adecuado para esta operacion
var b: Double = 9.5
var h: Double = 5.9
var a: Double

a = (b * h) / 2
print("El area es: \(a)")
