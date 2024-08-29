import LoanPageView from "@/views/LoansPage";
import { env } from "@/common/config/env";

async function getAllLoans(): Promise<Loan[]> {
  const response = await fetch(`${env.API_URL}/api/loans`);
  if (!response.ok) {
    throw new Error("Failed to fetch loans", { cause: response.statusText });
  }
  return response.json();
}

export default async function Loan() {
  let loans = await getAllLoans();

  return <LoanPageView loans={loans} />;
}
