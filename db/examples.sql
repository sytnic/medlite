-- Получить список всех доков и их спец-стей
SELECT docs.id as doc_id, docs.surname as doc_surname, docs.active as doc_active,
       docspec.spec_id
FROM docs
JOIN docspec
ON docs.id = docspec.doc_id
;

-- Получить список активных доков и их спец-стей
SELECT docs.id as doc_id, docs.surname as doc_surname, docs.active as doc_active,
       docspec.spec_id
FROM docs
JOIN docspec
ON docs.id = docspec.doc_id
WHERE docs.active = 1
;

-- Получить список активного дока по id и всех его спец-стей
SELECT docs.id as doc_id, docs.surname as doc_surname, docs.active as doc_active,
       docspec.spec_id
FROM docs
JOIN docspec
ON docs.id = docspec.doc_id
WHERE docs.id = 1 
AND docs.active = 1
;

-- Получить активного дока по id при указании одной его спец-сти
SELECT docs.id as doc_id, docs.surname as doc_surname, docs.active as doc_active,
       docspec.spec_id
FROM docs
JOIN docspec
ON docs.id = docspec.doc_id
WHERE docs.id = 1 
AND docs.active = 1
AND docspec.spec_id = 12
;

-- Получить по id спец-сти id всех доков и их имена
SELECT docspec.spec_id, docs.id as doc_id, docs.surname as doc_surname      
FROM docspec
JOIN docs
ON docspec.doc_id = docs.id
WHERE docspec.spec_id = 15
;

-- Получить по id спец-сти id всех активных доков и их имена
SELECT docspec.spec_id, docs.id as doc_id, 
       docs.firstname as doc_name, docs.surname as doc_surname      
FROM docspec
JOIN docs
ON docspec.doc_id = docs.id
WHERE docspec.spec_id = 15
AND docs.active = 1
;

-- Получить по id спец-сти всех (активных) доков, их имена и имена спец-стей
SELECT docspec.spec_id, docs.id as doc_id, 
       docs.firstname as doc_name, docs.surname as doc_surname,
       specs.specname     
FROM docspec

JOIN docs ON docspec.doc_id = docs.id
JOIN specs ON docspec.spec_id = specs.id 

WHERE docspec.spec_id = 15
-- AND docs.active = 1
;

-- Получить по id спец-сти всех (активных) доков, их имена, cost и имена спец-стей
SELECT docspec.spec_id, docs.id as doc_id, 
       docs.firstname as doc_name, docs.surname as doc_surname,
       docs.cost,
       specs.specname     
FROM docspec

JOIN docs ON docspec.doc_id = docs.id
JOIN specs ON docspec.spec_id = specs.id 

WHERE docspec.spec_id = 15
-- AND docs.active = 1
;

-- Получить по id дока (активного), его имена, id и имена всех его специальностей
SELECT docspec.spec_id, docs.id as doc_id, 
       docs.firstname as doc_name, docs.surname as doc_surname,
       specs.specname     
FROM docspec

JOIN docs ON docspec.doc_id = docs.id
JOIN specs ON docspec.spec_id = specs.id 

WHERE docs.id = 3
-- AND docs.active = 1
;

-- Получить по id спец-сти все id (активных) доков этой спец-сти и id всех времён этих доков 

SELECT docspec.spec_id, docs.id as id_doc, docs.surname, 
       doctime.id as id_time, doctime.date, doctime.time
FROM docspec
JOIN docs ON docspec.doc_id = docs.id
JOIN doctime ON docs.id = doctime.doc_id
WHERE docspec.spec_id = 12
AND docs.active = 1
AND date > (CURDATE() - 1)
ORDER by date ASC
LIMIT 500
;

-- Получить по id дока
-- его имена, id всех его времён, даты и часы
SELECT docs.id as id_doc, docs.firstname, docs.surname,
       doctime.id as id_time, doctime.date, doctime.time
FROM docs
JOIN doctime ON docs.id = doctime.doc_id
WHERE docs.id = 3
;

-- Добавлен статус и 
-- сортировка одновременно по дате и по времени
SELECT docs.id as id_doc, docs.firstname, docs.surname,
        doctime.id as id_time, doctime.date, doctime.time, doctime.status
FROM docs
JOIN doctime ON docs.id = doctime.doc_id
WHERE docs.id = {$safe_doc_id}

AND status = 0

AND date > (CURDATE() - INTERVAL 30 DAY)
ORDER by date, time ASC
LIMIT 500
;
