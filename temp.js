async function double(x){
  if (x % 3 === 0){
    throw new Error('failed to double');
  }else{
    return x*2;
  }
}

async function main() {
  const x = 6;
  const result1 = await double(x).catch(e => 0);
  console.log(result1);
}

main();