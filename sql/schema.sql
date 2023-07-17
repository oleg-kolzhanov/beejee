-- Table: public.todo

-- DROP TABLE IF EXISTS public.todo;

CREATE TABLE IF NOT EXISTS public.todo
(
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    name character varying(255) COLLATE pg_catalog."default",
    email character varying(255) COLLATE pg_catalog."default",
    text text COLLATE pg_catalog."default",
    done boolean NOT NULL DEFAULT false,
    CONSTRAINT todo_pkey PRIMARY KEY (id)
    )

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.todo
    OWNER to "beejee.ru.test";
-- Index: idx_todo_done

-- DROP INDEX IF EXISTS public.idx_todo_done;

CREATE INDEX IF NOT EXISTS idx_todo_done
    ON public.todo USING btree
    (done ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: idx_todo_email

-- DROP INDEX IF EXISTS public.idx_todo_email;

CREATE INDEX IF NOT EXISTS idx_todo_email
    ON public.todo USING btree
    (email COLLATE pg_catalog."default" ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: idx_todo_name

-- DROP INDEX IF EXISTS public.idx_todo_name;

CREATE INDEX IF NOT EXISTS idx_todo_name
    ON public.todo USING btree
    (name COLLATE pg_catalog."default" ASC NULLS LAST)
    TABLESPACE pg_default;