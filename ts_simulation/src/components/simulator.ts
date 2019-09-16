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
  T16='75-79'
}

export enum PlanA {
  A01='A01',
  None='none'
}

export interface TypeInfo {
  id: number
  plan: string
  price: number
}

export interface OptionItem {
  id: number;
  name: string;
}