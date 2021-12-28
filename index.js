function solution(question) {
  const solution = [];
  const perfectNumber = (angka) => {
    const faktor = [];

    for (let index = 1; index < angka; index++) {
      if (angka % index == 0) faktor.push(index);
    }

    var jumlahFaktor = 0;
    faktor.forEach((element) => {
      jumlahFaktor += element;
    });

    if (Math.abs(jumlahFaktor - angka) == 0) return "perfect";
    if (Math.abs(jumlahFaktor - angka) == 1) return "hampir";
    return "bukan";
  };

  jumlahSoal = question[0];
  for (let index = 1; index <= jumlahSoal; index++) {
    solution.push(perfectNumber(question[index]));
  }
  return solution;
}

console.log(solution([4, 3, 4, 5, 6]));
