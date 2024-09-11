"use server"

import { Loan } from "@/declarations";
import { env } from "@/common/config/env";
import { revalidateTag } from "next/cache";

export const createLoan = async (bookId: string): Promise<Loan | undefined> => {
  try {
    const response = await fetch(`${env.API_URL}/api/loans`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ bookId }),
    });
    if (!response.ok) {
      throw new Error("Failed to create loan", { cause: response.statusText });
    }

    revalidateTag('books');
    revalidateTag('loans');

    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error creating loan:", error);
    throw new Error("Failed to create loan", { cause: error });
  } 
}
