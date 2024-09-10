import { Dispatch, SetStateAction } from "react";

export type BookItemProps = Book & {};

export interface AuthorOptionType {
  id?: string;
  name: string;
  inputValue?: string;
}

export interface SelectAuthorProps {
  author: AuthorOptionType | undefined, 
  setAuthor: Dispatch<SetStateAction<AuthorOptionType>>
}