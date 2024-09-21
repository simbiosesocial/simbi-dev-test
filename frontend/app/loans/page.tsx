import { env } from "@/common/config/env";
import {BookLoanList} from "@/features/components";

async function getBookLoans(): Promise<BookLoan[]> {
  const response = await fetch(`${env.API_URL}/api/loans`);

  console.log(response)
  if (!response.ok) {
    throw new Error("Failed to fetch loans", { cause: response.statusText });
  }
  return response.json();
}

export default async function Loans() {
    
   const loans = await getBookLoans();

    return (
      <BookLoanList loans={loans}/>
  );
};