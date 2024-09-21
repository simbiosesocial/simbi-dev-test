import type { BookLoanProps } from "@/features/components/BookLoanForm/BookLoan.interface";
import axios from 'axios';

const api = axios.create({
  baseURL: `http://localhost:9000/api`,
});

export const createLoan = async (loanData: BookLoanProps) => {
  try {
    const response = await api.post('/loans', loanData);
    return response.data;
  } catch (error) {
    console.error('Erro ao criar empréstimo', error);
    throw error;
  }
};

