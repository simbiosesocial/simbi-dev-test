'use server'

import { Loan } from "@/declarations";
import { env } from "@/common/config/env";
import { revalidatePath, revalidateTag } from "next/cache";

export const finalizeLoan = async (loanId: string): Promise<Loan | undefined> => {
  try {
    const response = await fetch(`${env.API_URL}/api/loans/${loanId}/finalize`, {
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      throw new Error("Failed to finalize loan", { cause: response.statusText });
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error finalizing loan:", error);
    throw new Error("Failed to finalize loan", { cause: error });
  } 
}

export const renewLoan = async (loanId: string): Promise<Loan | undefined> => {
  try {
    const response = await fetch(`${env.API_URL}/api/loans/${loanId}/renew`, {
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      throw new Error("Failed to renew loan", { cause: response.statusText });
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error renewing loan:", error);
    throw new Error("Failed to renew loan", { cause: error });
  } 

  
}