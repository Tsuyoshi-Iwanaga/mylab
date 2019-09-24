//型定義
export enum Gender {
  Male='male',
  Female='female'
}

export enum Age {
  T1='0-4',
  T2='5-9',
  T3='10-14',
  T4='15-19',
  T5='20-24',
  T6='25-29',
  T7='30-34',
  T8='35-39',
  T9='40-44',
  T10='45-49',
  T11='50-54',
  T12='55-59',
  T13='60-64',
  T14='65-69',
  T15='70-74',
  T17='75-79',
  T18='80-84',
  T19='85-89'
}

export enum PlanA {
  A01='A01',
  None='none'
}

export enum PlanB {
  B01='B01',
  B02='B02',
  B11='B11',
  B12='B12',
  B01W='B01W',
  B02W='B02W',
  B11W='B11W',
  B12W='B12W',
  None='none'
}

export enum PlanC {
  C01='C01',
  C02='C02',
  C11='C11',
  C12='C12',
  C21='C21',
  C22='C22',
  None='none'
}

export enum PlanD {
  D01='D01',
  D02='D02',
  D03='D03',
  None='none'
}

export enum PlanE {
  E01='E01',
  E02='E02',
  E11='E11',
  E12='E12',
  None='none'
}

export enum PlanF {
  F01='F01',
  None='none'
}

export enum PlanG {
  G01='G01',
  None='none'
}

export enum PlanH {
  H01='H01',
  None='none'
}

export interface TypeInfo {
  id: number
  plan: string
  price: number
}

export interface SimulatorInfo {
  id: number
  price: number
  gender:Gender
  age:Age
  planList:string[]
}

export interface OptionItem {
  id: number;
  name: string;
  show: boolean;
}

export interface Simulator {
  id: number,
  price: number
  gender:Gender
  age:Age
  planList:string[]
}