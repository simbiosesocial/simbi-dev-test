import { z } from "zod";

const envSchema = z.object({
  API_URL: z.string(),
});

export const env = envSchema.parse({
  API_URL: process.env.API_URL || process.env.NEXT_PUBLIC_API_URL,
});
