import LoanPageView from "@/views/LoansPage";
import { env } from "@/common/config/env";
import { Loan as ILoan } from "@/declarations";

async function getAllLoans(): Promise<ILoan[]> {
  const response = await fetch(`${env.API_URL}/api/loans`, { next: { tags: ['loans'] }});
  if (!response.ok) {
    throw new Error("Failed to fetch loans", { cause: response.statusText });
  }
  return response.json();
}

export default async function Loan() {
  let loans = await getAllLoans();

  return <LoanPageView loans={loans} />;
}
