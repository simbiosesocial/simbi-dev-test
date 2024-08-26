import { env } from "@/common/config/env";

export const createLoan = async (bookId: string) => {
  try {
    const response = await fetch(`${env.API_URL}/api/loans`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ bookId }),
    });
    if (!response.ok) {
      throw new Error("Failed to fetch books", { cause: response.statusText });
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error creating loan:", error);
  } 
}